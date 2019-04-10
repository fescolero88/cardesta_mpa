<?php

namespace App\Http\Controllers;

use App\Dealer;
use App\Product;
use App\ProductImage;
use App\ProductOption;
use App\OptionType;

use Crypt;
use Illuminate\Routing\Route;
use App\UploadImage;
use App\CustomerRequest;
use App\ProductTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\CustomerPhoneInquiry;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CustomerRequestNotification;
use App\Notifications\ContactUsRequestSupport;
use App\Notifications\ContactUsRequestInfo;
use Illuminate\Support\Facades\Input;
use App\ContactUsInfo;
use Carbon\Carbon;

class HomeController extends Controller
{
    public $check =  false;
    public $googledealer = false;
    public $pagination = 10;
    public $total = [];
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(Request $request)
    {
        $this->check = \Session::has($request->ip());
        $this->googledealer = \Session::get($request->ip());

        setlocale(LC_MONETARY, "en_US.utf8");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $d = Dealer::find(1)->dealerproduct()->count();
        $this->renderHome();
        $home = $this->total;
        $search['makes_model'] = Product::select('make', 'model')->where('make', '!=', '')->groupBy('make', 'model')->remember(1440)->get()->pluck('make', 'model')->toArray();
        $search['makes'] = [];
        $makes = array_values($search['makes_model']);

        foreach ($makes as $make) {
            if (empty($search['makes'][$make])) {
                $search['makes'][$make] = 1;
            } else {
                $search['makes'][$make]++;
            }
        }
        $search['models'] = array_keys($search['makes_model']);

        //little changes in add id,with images
        $search['bodies'] = Product::with(['images'])->select(\DB::raw('id,body,count(body) as count'))->where('body', '!=', '')->groupBy('body')->remember(1440)->limit(24)->get()->toArray();

        $price['max'] = Product::max('sellingprice');
        $price['min'] = Product::min('sellingprice');
        for ($x = $price['min']; $x <= $price['max']; $x += 5000) {
            $search['prices'][] = $x;
        }
        $check = $this->check;
        $googledealer = $this->googledealer;

        //get feactured product
        $latitude = null;
        $longitude = null;
        $distance = 100;

        $featuredproduct = Product::with(['images'])->geofence($latitude ?? 43.18, $longitude ?? -77.75, 0, $distance)->whereHas('dealer', function ($query) {
            $query->where('is_featured', 1);
        })->orderBy('distance', 'ASC')->limit(4)->get();



        if (empty($featuredproduct)) {
            $featuredproduct = Product::with(['dealer', 'images'])->distance($latitude ?? 43.18, $longitude ?? -77.75)->where('dealer_id', 'tituswill')->orderBy('distance', 'ASC')->limit(4)->get();
        }

        $dealer = [];
        if (!$featuredproduct->isEmpty()) {
            $featureddealers = $featuredproduct[0]->dealer;
            $dealer['priceoff'] = $featureddealers->price_off ?? '';
            $dealer['name'] = $featureddealers->name ?? '';
            $dealer['city'] = $featureddealers->city ?? '';
            //$featuredproduct=$featureddealers->featuredproduct ?? $featuredproduct;

            foreach ($featuredproduct as $product) {
                $product->images = $product->images->filter(function ($image) {
                    return !empty($image->image);
                })->values();
            }
        }

        //$feacturedhome = $featuredproduct->toArray();

        //get recent product new product
        $productrecent = Product::geofence($latitude ?? 43.1856307, $longitude ?? -77.7565881, 0, $distance)->where('type', 'New')->orderBy('distance', 'ASC')->limit(16)->get();

        //get used product
        //$usedcars = Product::geofence($latitude ?? 43.1856307, $longitude ?? -77.7565881,0,$distance)->where('type','Used')->orderBy('distance', 'ASC')->limit(16)->get();

        $usedcars = Product::where('type', 'Used')->limit(16)->get();

        //get certified cars 
        //$certified_greatcars = Product::geofence($latitude ?? 43.1856307, $longitude ?? -77.7565881,0,$distance)->where('certified','True')->orderBy('distance', 'ASC')->limit(16)->get();

        $certified_greatcars = Product::where('certified', 'True')->limit(16)->get();

        //get featured image
        $feacturedImage = UploadImage::first();

        $home['featuredproduct'] = $featuredproduct;
        $home['recentproduct'] = $productrecent;
        $home['usedcar'] = $usedcars;
        $home['greatcars'] = $certified_greatcars;
        $home['featured_dealer'] = $dealer;

        return view('frontend/index', compact('home', 'search', 'check', 'googledealer', 'feacturedImage'));
    }

    function phoneEnquiry(Request $request)
    {
        $product = Product::with('dealer')->find($request->product_id);

        //crm@cardesta.com

        Notification::route('mail', 'crm@cardesta.com')
            ->notify(new CustomerPhoneInquiry($product));
    }

    public function car_list(Request $request, $dealername = null, $id = null, $zip = null)
    {
        $filterresult = $this->filterRequest($request, $id);
        $initial = 0;
        $search_filterable = [];
        if ($filterresult) {
            $search_filterable['product'] = $filterresult;
            if (($this->check)) {
                $search_filterable['product']['dealer'] = $this->googledealer;
                $initial = 1;
            }
        } else {

            if (!empty($id)) {
                $dealer = Dealer::where('dealer_id', $id)->first();

                $paginated = DB::table('products')
                    ->leftJoin('dealer', 'products.dealer_id', '=', 'dealer.dealer_id')
                    ->where('products.dealer_id', $id)
                    ->select('products.*')
                    ->paginate($this->pagination);
                $products = $paginated->toArray();


                $products['data'] = collect($products['data'])->map(function ($product) use ($dealer) {
                    $product->images = ProductImage::where('product_id', $product->id)->get();
                    $product->dealer = $dealer;
                    return $product;
                })->toArray();

                $search_filterable['product'] = $products;
                $search_filterable['product']['dealer'] = $dealer;
            } else {
                $search_filterable['product'] = Product::with(['images', 'dealer']);
                $paginated = $search_filterable['product']->orderBy('updated_at', 'desc')->paginate($this->pagination);
                $search_filterable['product'] = $paginated->toArray();
            }
            $initial = 1;
        }

        $models = Product::distinct('model')->where('model', '!=', '')->limit(100)->remember(1440)->get();

        $make_models = [];

        $models->map(function ($model) use (&$make_models) {

            if (!isset($make_models[$model->make])) {
                $make_models[$model->make][] = ['model' => $model->model];
            } else {
                $make_models[$model->make][] = ['model' => $model->model];
            }

            $make_models[''][] = ['model' => $model->model];
        });

        $search_filterable['makes_model'] = $make_models;

        $search_filterable['market_days']['max'] = !empty($request->max_market_days) ? $request->max_market_days : 650;
        $search_filterable['market_days']['min'] = 0;

        //$search_filterable['extcolor'] = Product::select('extcolorhexcode as exteriorcolor')->groupBy('extcolorhexcode')->remember(1440)->get()->filter(function($exteriorcolor){ return !empty($exteriorcolor->exteriorcolor); })->values()->toArray();
        $search_filterable['extcolor'] = Product::select('exteriorcolor as exteriorcolor')->groupBy('extcolorhexcode')->remember(1440)->get()->filter(function ($exteriorcolor) {
            return !empty($exteriorcolor->exteriorcolor);
        })->values()->toArray();

        $search_filterable['intcolor'] = Product::select('interiorcolor')->groupBy('interiorcolor')->remember(1440)->get()->map(function ($interiorcolor) {
            $interiorcolor->interiorcolor = preg_replace("~[^a-z0-9:]~i", "", $interiorcolor->interiorcolor);
            return $interiorcolor;
        })->filter(function ($interiorcolor) {
            return !empty($interiorcolor->interiorcolor);
        })->values()->toArray();;

        $search_filterable['drivetrain'] = Product::select('drivetrain')->groupBy('drivetrain')->remember(1440)->get()->filter(function ($drivetrain) {
            return !empty($drivetrain->drivetrain);
        })->values()->toArray();

        $search_filterable['body'] = Product::selectRaw('body,count(body) as count')->groupBy('body')->remember(1440)->orderBy('body', 'desc')->get()->filter(function ($body) {
            return !empty($body->body);
        })->values()->toArray();

        $search_filterable['price']['max'] = !empty($request->max_price) ? $request->max_price : Product::select('sellingprice')->max('sellingprice');

        $search_filterable['price']['min'] = Product::select('sellingprice')->min('sellingprice');



        $search_filterable['mileage']['min'] = Product::min('miles');
        $search_filterable['mileage']['max'] = Product::max('miles');
        $search_filterable['mileage']['highway']['max'] = Product::max('highwaympg');
        $search_filterable['mileage']['highway']['min'] = Product::min('highwaympg');

        $search_filterable['transmission_speed'] = Product::select('transmission_speed')
            ->distinct()
            ->orderBy('transmission_speed', 'desc')->remember(1440)
            ->get()
            ->pluck('transmission_speed')
            ->filter(function ($transmission_speed) {
                return !empty($transmission_speed);
            })
            ->values()
            ->toArray();
        $search_filterable['make'] = Product::select('make')->groupBy('make')->remember(1440)->get()->filter(function ($make) {
            return !empty($make->make);
        })->values()->toArray();
        $search_filterable['model'] = Product::select('model');
        if (!empty($request->search_make)) {
            $search_filterable['model'] = $search_filterable['model']->where('make', $request->search_make);
        }

        $search_filterable['model'] = $search_filterable['model']->groupBy('model')->remember(1440)->get()->filter(function ($model) {
            return !empty($model->model);
        })->values()->toArray();
        // $search_filterable['dealerzip'] =Dealer::select('zip')->distinct()->orderBy('zip','desc')->get()->toArray();
        $search_filterable['passengercapacity'] = Product::select('passengercapacity')
            ->distinct()
            ->orderBy('passengercapacity', 'desc')->remember(1440)
            ->get()
            ->pluck('passengercapacity')
            ->filter()
            ->values()
            ->toArray();
        $search_filterable['dateinstock']['max'] = Product::max('dateinstock');
        $search_filterable['dateinstock']['min'] = Product::min('dateinstock');
        $search_filterable['fueltype'] = Product::select('fuel_type')->groupBy('fuel_type')->remember(1440)->get()->filter(function ($fuel_type) {
            return !empty($fuel_type->fuel_type);
        })->values()->toArray();
        
        $search_filterable['engine']['cylinder'] = Product::select('enginecylinders')->groupBy('enginecylinders')->remember(1440)->get()->filter(function ($enginecylinders) {
            return !empty($enginecylinders->enginecylinders);
        })->values()->toArray();
        $search_filterable['engine']['displacement'] = Product::select('enginedisplacement')->groupBy('enginedisplacement')->remember(1440)->get()->filter(function ($enginedisplacement) {
            return !empty($enginedisplacement->enginedisplacement);
        })->values()->toArray();

        $search_filterable['search'] = [
            'type' => '',
            'sellingprice' => $search_filterable['price']['min'] . ',' . (!empty($request->max_price) ? $request->max_price : $search_filterable['price']['max']),
            'miles' => $search_filterable['mileage']['min'] . ',' . $search_filterable['mileage']['max'],
            'market_days' => $search_filterable['market_days']['min'] . ',' . $search_filterable['market_days']['max'],
            'extcolorhexcode' => '',
            'interiorcolor' => '',
            'drivetrain' => '',
            'transmission' => '',
            'transmission_speed' => '',
            'fuel_type' => '',
            'body' => $request->body ?? '',
            'make' => '',
            'model' => '',
            'passengercapacity' => '',
            'certified' => $request->certified ?? '',
            'date' => '',
            'price' => '',
            'search' => '',
            'zip' => '',
            'sortBy' => '',
            'dealer_id' => $id ?? $request->dealer_id ?? '',
            'search_make' => $request->search_make ?? '',
            'search_model' => $request->search_model ?? '',
            'search_zip' => $request->search_zip ?? '',
            'search_distance' => $request->search_distance ?? '',
            'search_type' => $request->search_type ?? '',
            'stm_lat' => $request->stm_lat ?? '',
            'stm_lng' => $request->stm_lng ?? '',
        ];


        setlocale(LC_MONETARY, "en_US.utf8");
        if (!empty($search_filterable['product']['data'])) {

            $search_filterable['product']['data'] = array_map(function ($p) {
                if (!is_object($p))
                    $p = (object)$p;

                $price = $p->sellingprice ?? $p->msrp ?? 0;
                $p->display_price = money_format('%n', $price);
                return $p;
            }, $search_filterable['product']['data']);
        }

        //cars listing recent,used,certified

        $latitude = null;
        $longitude = null;
        $distance = 100;

        //get recent product new product
        $productrecent = Product::geofence($latitude ?? 43.1856307, $longitude ?? -77.7565881, 0, $distance)->where('type', 'New')->orderBy('distance', 'ASC')->limit(16)->get();

        $usedcars = Product::where('type', 'Used')->limit(16)->get();

        $certified_greatcars = Product::where('certified', 'True')->limit(16)->get();

        //close car listing partials
        if (!$request->ajax()) {
            if ($initial) {
                return view('frontend/list', [
                    'search_filterable' => $search_filterable,
                    'list' => $search_filterable,
                    'pagination' => $paginated->links() ?? '',
                    'id' => $id,
                    'request' => $request,
                    'check' => $this->check,
                    'googledealer' => $this->googledealer,
                    'recentproduct' => $productrecent,
                    'usedproduct' => $usedcars,
                    'greatcars' => $certified_greatcars


                ]);
            }

            if ($request->search_from) {
                return view('frontend/list', [
                    'search_filterable' => $search_filterable,
                    'list' => $search_filterable,
                    'pagination' => !empty($paginated) ?  $paginated->links() : '',
                    'id' => $id,
                    'request' => $request,
                    'check' => $this->check,
                    'googledealer' => $this->googledealer,
                    'recentproduct' => $productrecent,
                    'usedproduct' => $usedcars,
                    'greatcars' => $certified_greatcars
                ]);
            }
        }

        return response()->json($search_filterable);
    }

    public function listDetails(Request $request, $make, $model, $dealername, $city, $vin)
    {
        $requestip = request()->ip();

        $product = Product::with('ProductOption.option', 'ProductOption.category', 'images', 'dealer')->where('vin', $vin)->first();

        $product->images = $product->images->filter(function ($image) {
            return !empty($image->image);
        })->values();


        $featuredproduct = Product::with('images', 'dealer')
            ->orderBy('no_of_visit', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        foreach ($featuredproduct as $prod) {

            $prod->images = $prod->images->filter(function ($image) {
                return !empty($image->image);
            })->values();
        }

        if (!$featuredproduct->isEmpty()) {
            unset($featuredproduct[0]);
        }



        $checkuservisit = ProductTracking::where('product_id', $product->id)->where('visited_ip', $requestip)->get();

        if ($checkuservisit->isEmpty()) {
            Product::where('vin', $vin)
                ->update(['no_of_visit' => $product->no_of_visit + 1]);

            $newuservisit = new ProductTracking();
            $newuservisit->product_id = $product->id;
            $newuservisit->visited_ip = $requestip;
            $newuservisit->save();
        }


        $p = $product->toArray();
        $product_option = [];
        if (!empty($p['product_option']))
            $product_option = $p['product_option'];

        $new_product_options = [];
        foreach ($product_option as $options) {
            $new_product_options[$options['category']['type']][] = [
                'id' => $options['option']['id'],
                'name' => $options['option']['name']
            ];
        }

        $product->product_options = $new_product_options;

        return view('frontend/listdetails', ['product' => $product, 'featuredproduct' => $featuredproduct, 'check' => $this->check, 'googledealer' => $this->googledealer]);
    }

    public function dealerList(Request $request)
    {

        $featured = Dealer::where('is_featured', 1)->withCount('dealerproduct')->limit(5)->get();

        $dealers = Dealer::where('is_featured', '!=', 1)->withCount('dealerproduct');

        //get make cars type
        $make = Product::groupBy('make')->pluck('make');

        if (!empty($request->stm_lng) && !empty($request->stm_lat)) {

            $max_distance = $request->searchdistance  ?? 100;
            $paginate = $this->pagination;
            $page = $request->get('page', 1);


            $offSet = ($page * $paginate) - $paginate;

            $result = $dealers->geofence($request->stm_lat, $request->stm_lng, 0, $max_distance)->orderBy('distance', 'ASC')->get();


            $itemsForCurrentPage = array_values(array_slice($result->toArray(), $offSet, $paginate, true));
            $result = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, $result->count(), $paginate, $page);

            $result->setPath(url()->current());
            $dealers = $result;
        } else if (empty($request->stm_lng) && !empty($request->zip) && empty($request->stm_lat)) {

            $position = \Geocoder::getCoordinatesForAddress($request->zip);

            $max_distance = $request->searchdistance  ?? 100;
            $paginate = $this->pagination;
            $page = $request->get('page', 1);


            $offSet = ($page * $paginate) - $paginate;

            $result = $dealers->geofence($position['lat'], $position['lng'], 0, $max_distance)->orderBy('distance', 'ASC')->get();


            $itemsForCurrentPage = array_values(array_slice($result->toArray(), $offSet, $paginate, true));
            $result = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, $result->count(), $paginate, $page);

            $result->setPath(url()->current());
            $dealers = $result;
        } else if (empty($request->stm_lng) && empty($request->zip) && empty($request->stm_lat) && !empty($request->ca_location)) {

            $position = \Geocoder::getCoordinatesForAddress($request->ca_location);

            $max_distance = $request->searchdistance  ?? 100;
            $paginate = $this->pagination;
            $page = $request->get('page', 1);


            $offSet = ($page * $paginate) - $paginate;

            $result = $dealers->geofence($position['lat'], $position['lng'], 0, $max_distance)->orderBy('distance', 'ASC')->get();


            $itemsForCurrentPage = array_values(array_slice($result->toArray(), $offSet, $paginate, true));
            $result = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, $result->count(), $paginate, $page);

            $result->setPath(url()->current());
            $dealers = $result;
        } else {
            $dealers = $dealers->paginate($this->pagination);
        }

        $check = $this->check;
        $googledealer = $this->googledealer;

        return view('frontend.dealerlist', compact('dealers', 'featured', 'check', 'googledealer', 'make'));
    }

    private function renderHome()
    {

        $noofproduct = Product::count();
        $noofdealer = Dealer::count();
        $dealer = [];

        $this->total['noofproduct'] = $noofproduct;
        $this->total['noofdealer'] = $noofdealer;
    }

    private function filterRequest($request, $id)
    {
        $querystring = $request->all();

        if (array_key_exists('search_make', $querystring) && array_key_exists('search_model', $querystring) && array_key_exists('search_body', $querystring)) {
            unset($querystring['search_body']);
        }

        if (empty($querystring)) {
            return [];
        }

        $type = [
            'market_days' => 'val',
            'extcolorhexcode' => 'option',
            'interiorcolor' => 'option',
            'drivetrain' => 'option',
            'transmission' => 'option',
            'transmission_speed' => 'option',
            'engine' => 'multiple option',
            'fuel_type' => 'option',
            'body' => 'option',
            'make' => 'option',
            'model' => 'option',
            'passengercapacity' => 'option',
            'certified' => 'option',
            'sellingprice' => 'val',
            'miles' => 'val',
            'date' => 'option',
            'sortBy' => 'order',
            'search' => 'txt',
            'zip' => 'dealer',
            'dealer_id' => 'option',
            'search_make' => '',
            'search_model' => '',
            'search_zip' => '',
            'search_distance' => '',
            'search_type' => '',
            'search_body' => '',
            'max_price'   => 'price'
        ];
        //$product=DB::table('products');

        $product = Product::with(['images', 'dealer']);
        if (!empty($id)) {
            $product = Product::with(['images', 'dealer'])->where('dealer_id', $id);
        }

        $result = $product;
        foreach ($querystring as $key => $val) {

            if (empty($val)) continue;

            if (array_key_exists($key, $type)) {
                if ($type[$key] === 'option') {
                    $val = explode(',', $val);
                    $result = $result->where(function ($q) use ($key, $val) {
                        foreach ($val as $v) {
                            if (($key === 'certified') && ($v === 'False')) {
                                $q->where('type', 'Used')->orWhere($key, $v)->orWhereNull('certified');
                            } else {
                                $q->where('type', 'Used')->Where($key, $v);
                            }
                        }
                    });

                } elseif ($type[$key] === 'val') {
                    $val = explode(',', $val);
                    if ($key == 'market_days') {
                        $result = $result->where(function ($q) use ($val) {
                            $future_date_range = [
                                Carbon::today()->addDays($val[0])->toDateString(),
                                Carbon::today()->addDays($val[1])->toDateString()
                            ];
                            $past_date_range = [
                                Carbon::today()->subDays($val[1])->toDateString(),
                                Carbon::today()->subDays($val[0])->toDateString()
                            ];
                            
                            $q->whereBetween('dateinstock', $past_date_range)->orWhereBetween('dateinstock', $future_date_range);
                        });
                    } else {
                        $result = $result->where(function ($q) use ($key, $val) {
                            $q->where($key, '>=', $val[0])->where($key, '<=', $val[1]);
                        });
                    }
                } elseif ($type[$key] === 'order') {
                    if (empty($val)) {
                        $result = $result->orderBy('updated_at', $val);
                    } else {
                        $val = explode(',', $val);
                        $result = $result->orderBy($val[0], $val[1]);
                    }
                } elseif ($type[$key] === 'bool') {
                    if ($val == 'true') {
                        $result = $result->where('certified', 'TRUE');
                    } else {
                        $result = $result->where('certified', 'FALSE');
                    }
                } elseif ($type[$key] === 'txt') {
                    $result = $result->where('make', 'like', '%' . $val . '%')->where('model', 'like', '%' . $val . '%');
                } elseif ($type[$key] === 'price') {
                    $result = $result->whereBetween('sellingprice', [0, $val]);
                } elseif ($type[$key] === 'multiple option') {
                    $val = explode(',', $val);
                    $result = $result->where(function ($q) use ($key, $val) {
                        foreach ($val as $v) {
                            $fields = explode('-', $v);
                            
                            if ($key === 'engine') {
                                $q->orWhere('enginecylinders', $fields[0])->orWhere('enginedisplacement', $fields[1]);
                            }
                        }
                    });
                } else {
                    $key = substr($key, 0 + strlen('search_'), strlen($key));
                    if ($key == 'distance' || $key == 'zip') {
                        continue;
                    } else {
                        $result = $result->where($key, $val);
                    }
                }
            }
        }
        $totalCount = $result->count();

        if (!empty($querystring['stm_lat']) && !empty($querystring['stm_lng'])) {
            $max_distance = $querystring['search_distance'] ?? 100;
            $paginate = $this->pagination;
            $page = $request->get('page', 1);


            $offSet = ($page * $paginate) - $paginate;
            // $getlocation=$this->getlatlong($searchdistance,$querystring['stm_lat'],$querystring['stm_lng']);

            // $result=$result->whereBetween('latitude',[$getlocation['minlat'],$getlocation['maxlat']])
            //     ->whereBetween('longitude',[$getlocation['minlng'],$getlocation['maxlng']])->orderBy('latitude','asc')->orderBy('longitude','asc');

            $result = $result->geofence($querystring['stm_lat'], $querystring['stm_lng'], 0, $max_distance)->orderBy('distance', 'ASC')->limit($offSet + 10000)->get();


            $itemsForCurrentPage = array_values(array_slice($result->toArray(), $offSet, $paginate, true));
            $result = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, $result->count(), $paginate, $page);

            $result->setPath(url()->current());
            $result = $result->toArray();

            return $result;
        } else if (!empty($querystring['search_zip'])) {

            $position = \Geocoder::getCoordinatesForAddress($querystring['search_zip']);


            $max_distance = $querystring['search_distance'] ?? 100;
            $paginate = $this->pagination;
            $page = $request->get('page', 1);


            $offSet = ($page * $paginate) - $paginate;

            $result = $result->geofence($position['lat'], $position['lng'], 0, $max_distance)->orderBy('distance', 'ASC')->limit($offSet + 10000)->get();


            $itemsForCurrentPage = array_values(array_slice($result->toArray(), $offSet, $paginate, true));
            $result = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, $result->count(), $paginate, $page);

            $result->setPath(url()->current());
            $result = $result->toArray();
            
            return $result;
        }
        $result = $result->paginate($this->pagination)->toArray();

        return $result;
    }

    private function filtersearchoption($request, $result)
    {
        $querystring = $request->all();

        $type = [
            'year' => 'val',
            'exteriorcolor' => 'option',
            'interiorcolor' => 'option',
            'drivetrain' => 'option',
            'transmission' => 'option',
            'transmission_speed' => 'option',
            'fuel_type' => 'option',
            'body' => 'option',
            'make' => 'option',
            'model' => 'option',
            'passengercapacity' => 'option',
            'certified' => 'option',
            'sellingprice' => 'val',
            'citympg' => 'val',
            'date' => 'option',
            'sortBy' => 'order',
            'search' => 'txt',
            'zip' => 'dealer',
            'dealer_id' => 'option',
            'search_make' => '',
            'search_model' => '',
            'search_zip' => '',
            'search_distance' => '',
            'search_type' => '',
        ];

        foreach ($querystring as $key => $val) {
            if (empty($val)) continue;

            if (array_key_exists($key, $type)) {
                if ($type[$key] === 'option') {
                    $val = explode(',', $val);
                    $result = $result->whereIn($key, $val);
                } elseif ($type[$key] === 'val') {
                    $val = explode(',', $val);
                    $result = $result->whereBetween($key, $val);
                } elseif ($type[$key] === 'order') {
                    if (empty($val)) {
                        $result = $result->orderBy('updated_at', $val);
                    } else {
                        $val = explode(',', $val);
                        $result = $result->orderBy($val[0], $val[1]);
                    }
                } elseif ($type[$key] === 'bool') {
                    if ($val == 'true') {
                        $result = $result->where('certified', 'TRUE');
                    } else {
                        $result = $result->where('certified', 'FALSE');
                    }
                } elseif ($type[$key] === 'txt') {
                    $result = $result->where('make', 'like', '%' . $val . '%')->where('model', 'like', '%' . $val . '%');
                } else {
                    $key = substr($key, 0 + strlen('search_'), strlen($key));
                    if ($key == 'distance') {
                        $result = $result->where($key, '<=', floatval($val));
                    } else {
                        $result = $result->where($key, $val);
                    }
                }
            }
        }

        return $result;
    }

    public function xmlSitemap()
    { }

    public function customerRequest(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'fname' => 'required',
            'tel' => 'required|numeric',
            'offer_price' => 'required|numeric',
        ]);

        $newrequest = new CustomerRequest;
        $newrequest->name = $request->fname . ' ' . $request->lname;
        $newrequest->email = $request->email;
        $newrequest->phone = $request->tel;
        $newrequest->description = $request->message;
        $newrequest->offer_price = $request->offer_price;
        $newrequest->dealer_id = $request->dealer_id;
        $newrequest->inventory_id = $request->product_id;
        $newrequest->save();

        $product = Product::with('dealer')->find($request->product_id);


        $dealermail = Dealer::where('dealer_id', $request->dealer_id)->get()->toArray();
        $dealermail = $dealermail[0]['lead_email'] ?? 'preeti.gupta@daffodilsw.com';

        // $dealermail = 'riazcool77@gmail.com';

        Notification::route('mail', $dealermail)
            ->notify(new CustomerRequestNotification($newrequest, $product));

        return response()->json('success');
    }

    public function getlatlong($distance, $lat, $lng)
    {
        $distance *= 1.60934;
        $radius = 6371 * 1.60934; //miles
        $location = [];
        // latitude boundaries
        $location['maxlat'] = $lat + rad2deg($distance / $radius);
        $location['minlat'] = $lat - rad2deg($distance / $radius);

        // longitude boundaries (longitude gets smaller when latitude increases)
        $location['maxlng'] = $lng + rad2deg($distance / $radius / cos(deg2rad($lat)));
        $location['minlng'] = $lng - rad2deg($distance / $radius / cos(deg2rad($lat)));

        return $location;

        //$results = DB::select(DB::raw('SELECT id, ( 3959 * acos( cos( radians(' . $lat . ') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(' . $lng . ') ) + sin( radians(' . $lat .') ) * sin( radians(lat) ) ) ) AS distance FROM articles HAVING distance < ' . $distance . ' ORDER BY distance') );

        // return $results;
    }

    public function getCloserProduct(Request $request)
    {



        // $getlocation=$this->getlatlong($request->distance,$request->lat ?? 43.1856307,$request->lng ?? -77.7565881);

        $productrecent = Product::geofence($request->lat ?? 43.1856307, $request->lng ?? -77.7565881, 0, $request->distance)->orderBy('distance', 'ASC')->limit(8)->get();

        // $productrecent=Product::with(['images','dealer'])
        //     ->whereBetween('latitude',[$getlocation['minlat'],$getlocation['maxlat']])
        //     ->orWhereBetween('longitude',[$getlocation['minlng'],$getlocation['maxlng']])
        //     ->orderBy('created_at','desc')->limit(8)->get();

        foreach ($productrecent as $product) {
            $product->images = $product->images->filter(function ($image) {
                return !empty($image->image);
            })->values();
        }


        $featuredproduct = Product::with(['images'])->geofence($request->lat ?? 43.18, $request->lng ?? -77.75, 0, $request->distance)->whereHas('dealer', function ($query) {
            $query->where('is_featured', 1);
        })->orderBy('distance', 'ASC')->limit(8)->get();

        if (empty($featuredproduct)) {
            $featuredproduct = Product::with(['dealer', 'images'])->distance($request->lat ?? 43.18, $request->lng ?? -77.75)->where('dealer_id', 'tituswill')->orderBy('distance', 'ASC')->limit(8)->get();
        }

        $dealer = [];
        if (!$featuredproduct->isEmpty()) {
            $featureddealers = $featuredproduct[0]->dealer;
            $dealer['priceoff'] = $featureddealers->price_off ?? '';
            $dealer['name'] = $featureddealers->name ?? '';
            $dealer['city'] = $featureddealers->city ?? '';
            $featuredproduct = $featureddealers->featuredproduct ?? $featuredproduct;

            foreach ($featuredproduct as $product) {
                $product->images = $product->images->filter(function ($image) {
                    return !empty($image->image);
                })->values();
            }
        }
        $home['recentproduct'] = $productrecent;
        $home['featuredproduct'] = $featuredproduct;
        $home['featured_dealer'] = $dealer;

        $html['recentproduct'] = view('frontend/recent-products', ['home' => $home])->render();
        $html['featuredproduct'] = view('frontend/featured-products', ['home' => $home])->render();


        return $html;
    }

    public function aboutUs()
    {
        $check = $this->check;
        $googledealer = $this->googledealer;
        return view('footerlink.aboutus', compact('check', 'googledealer'));
    }

    public function contactUs()
    {
        $check = $this->check;
        $googledealer = $this->googledealer;
        return view('footerlink.contact', compact('check', 'googledealer'));
    }

    public function privacyPolicy()
    {
        $check = $this->check;
        $googledealer = $this->googledealer;
        return view('footerlink.privacypolicy', compact('check', 'googledealer'));
    }

    public function ajaxGetModel(Request $request)
    {
        $model = Product::select('model');
        if ($request->make === null) {
            $model = $model->distinct()->orderBy('model', 'asc')->limit(100)->get();
        } else {
            $model = $model->distinct()->where('make', $request->make)->orderBy('model', 'asc')->get();
        }

        if ($request->has('home')) {
            $model = view('frontend/ajax/model', compact('model'))->render();
        }

        return response()->json($model);
    }

    /**
     * contact us details save
     */
    public function saveContactUs(Request $request)
    {
        try {

            if (!empty($request->type == "more_info")) {
                $request->validate([
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'title' => 'required',
                    'dealership_type' => 'required',
                    'dealership_name' => 'required',
                    'dealership_street_address' => 'required',
                    'shipping_country' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required|numeric',
                ]);
            }

            if (!empty($request->type == "customer_support")) {

                $request->validate([
                    'zipcode' => 'required',
                    'city' => 'required',
                    'contact_person' => 'required',
                    'dealership_name' => 'required',
                    'issuedetails' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required|numeric',
                ]);
            }


            $newrequest = new ContactUsInfo;
            if (!empty($request->type == "more_info")) {
                $newrequest->first_name = !empty($request->first_name) ? $request->first_name : "";
                $newrequest->last_name = !empty($request->last_name) ? $request->last_name : "";
                $newrequest->title = !empty($request->title) ? $request->title : "";
                $newrequest->dealership_type = !empty($request->dealership_type) ? $request->dealership_type : "";
                $newrequest->dealership_name = !empty($request->dealership_name) ? $request->dealership_name : "";
                $newrequest->dealership_street_address = !empty($request->dealership_street_address) ? $request->dealership_street_address : "";
                $newrequest->city = !empty($request->city) ? $request->city : "";
                $newrequest->state = !empty($request->state) ? $request->state : "";
                $newrequest->zipcode = !empty($request->zipcode) ? $request->zipcode : "";
                $newrequest->shipping_country = !empty($request->shipping_country) ? $request->shipping_country : "";
                $newrequest->email = !empty($request->email) ? $request->email : "";
                $newrequest->phone = !empty($request->phone) ? $request->phone : "";
                $newrequest->description = !empty($request->description) ? $request->description : "";
                $newrequest->dealer_advantage = !empty($request->dealer_advantage) ? $request->dealer_advantage : "";
                $newrequest->type = !empty($request->type) ? $request->type : "";
            }

            if (!empty($request->type == "customer_support")) {
                $newrequest->issue_type = !empty($request->issue_type) ? $request->issue_type : "";
                $newrequest->issuedetails = !empty($request->issuedetails) ? $request->issuedetails : "";
                $newrequest->dealership_name = !empty($request->dealership_name) ? $request->dealership_name : "";
                $newrequest->contact_person = !empty($request->contact_person) ? $request->contact_person : "";
                $newrequest->city = !empty($request->city) ? $request->city : "";
                $newrequest->state = !empty($request->state) ? $request->state : "";
                $newrequest->zipcode = !empty($request->zipcode) ? $request->zipcode : "";
                $newrequest->shipping_country = !empty($request->shipping_country) ? $request->shipping_country : "";
                $newrequest->email = !empty($request->email) ? $request->email : "";
                $newrequest->phone = !empty($request->phone) ? $request->phone : "";
                $newrequest->type = !empty($request->type) ? $request->type : "";
            }

            //save data in database
            $save = $newrequest->save();

            if ($save) {

                //send email to
                $adminmail_to = "leads@cardesta.com";

                if ($request->type == "more_info") {
                    //send mail
                    Notification::route('mail', $adminmail_to)->notify(new ContactUsRequestInfo($newrequest));
                }

                if (!empty($request->type == "customer_support")) {
                    Notification::route('mail', $adminmail_to)->notify(new ContactUsRequestSupport($newrequest));
                }

                return response()->json('success');
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /*
     * Search Dealers [by name,by make,by distance and zip]
     */
    public function searchDealer(Request $request)
    {

        try {

            //search by dealer name
            if ($request->searchbyname == "searchbyname") {
                if (empty($request->dealer_name)) {
                    $response = array(
                        'status' => 'failure',
                        'msg' => "The dealer name field is required.",
                    );
                    return response()->json($response);
                } else {
                    $dealer_name = $request->dealer_name;
                    $dealers = Dealer::where('is_featured', '!=', 1)->where('name', 'like', '%' . $dealer_name . '%')->get();
                    if (!empty($dealers)) {
                        return ['response' => view('frontend/partials/dealers_page_list', compact('dealers'))->render()];
                    } else {
                        $dealers = [];
                        return ['response' => view('frontend/partials/dealers_page_list', compact('dealers'))->render()];
                    }
                }
            }

            //serch by make
            if ($request->searchbymake == "searchbymake") {
                if (empty($request->make)) {
                    $response = array(
                        'status' => 'failure',
                        'msg' => "Please check checkbox first.",
                    );

                    return response()->json($response);
                } else {
                    $make = $request->make;
                    $product_make = Product::whereIn('make', $request->make)->groupBy('dealer_id')->pluck('dealer_id');
                    if (!empty($product_make)) {
                        $dealers = Dealer::whereIn('dealer_id', $product_make)->get();
                        if (!empty($dealers)) {
                            return ['response' => view('frontend/partials/dealers_page_list', compact('dealers'))->render()];
                        } else {
                            $dealers = [];
                            return ['response' => view('frontend/partials/dealers_page_list', compact('dealers'))->render()];
                        }
                    }
                }
            }

            //search by zip and distance
            if ($request->searchbyzip == "searchbyzip") {
                $distance = $request->distance;
                $zip = $request->zip;
                $dealers = Dealer::where('distance', '<=', $distance)->orWhere('zip', $zip)->get();
                if (!empty($dealers)) {
                    return ['response' => view('frontend/partials/dealers_page_list', compact('dealers'))->render()];
                } else {
                    $dealers = [];
                    return ['response' => view('frontend/partials/dealers_page_list', compact('dealers'))->render()];
                }
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
	public function gettab(Request $request){
        $model=Product::select('make');
        if($request->tab===null){
            $model=$model->distinct()->orderBy('make','asc')->limit(100)->get();
        }
        else{
            $model=$model->distinct()->where('type',$request->tab)->orderBy('make','asc')->get();
        }
        return response()->json($model);
    }
	 public function getmake(Request $request){
        $model=Product::select('model');
        if($request->tab===null){
            $model=$model->distinct()->orderBy('model','asc')->limit(100)->get();
        }
        else{
            $model=$model->distinct()->where('type',$request->tab)->where('make',$request->make)->orderBy('model','asc')->get();
        }
        return response()->json($model);
    }
}
