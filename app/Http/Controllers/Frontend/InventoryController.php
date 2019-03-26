<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\TradeValueRequest;
use App\Http\Requests\Frontend\VehicleAvailabilityRequest;
use App\Http\Requests\Frontend\BestPriceRequest;
use App\Product;
use App\Helpers\MailHelper;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller {

    /**
     * This function is used to send mail to the dealer regarding vehicle Trade 
     * in Value request.
     * 
     * @param Request $request
     * @return Json $response
     * @author LY
     */
    public function requestTradingValue(TradeValueRequest $request) {
        //Get Request Data
        $requestData = $request->all();

        try {
            //Get product id
            $productId = $requestData['product_id'] ?? 0;

            //Get Dealer and product details
            if (!empty($productId)) {
                $product = Product::with(['dealer'])->where('id', $productId)->first();

                if (!empty($product['dealer']['email'])) {

                    $blade = 'tradeInValue';
                    $params = array();
                    $params['data'] = array();
                    $params['to'] = $product['dealer']['email'];
                    $params['subject'] = "Requested Trade In Value";
                    $params['data']['to_name'] = $product['dealer']['name'];
                    $params['data']['user-name'] = $requestData['first_name'] . ' ' . $requestData['last_name'];
                    $params['data']['user-phone'] = $requestData['phone'];
                    $params['data']['user-email'] = $requestData['email'];
                    $params['data']['user-comment'] = $requestData['comment'] ?? '';
                    $params['data']['vehicle-year'] = $requestData['year'] ?? '';
                    $params['data']['vehicle-make'] = $requestData['make'] ?? '';
                    $params['data']['vehicle-model'] = $requestData['model'] ?? '';
                    $params['data']['vehicle-trim'] = $requestData['trim'] ?? '';
                    $params['data']['vehicle-mileage'] = $requestData['mileage'] ?? '';
                    $params['data']['vehicle-vin'] = $requestData['vin'] ?? '';

                    //Send mail
                    MailHelper::sendMail($params, $blade);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'status_code' => 500]);
        }
        
        return response()->json(['status' => true, 'status_code' => 200]);
    }
    
    /**
     * This function is used to send mail to the dealer to check avaialbility of vehicle.
     * 
     * @param Request $request
     * @return Json $response
     * @author LY
     */
    public function requestVehicleAvailability(VehicleAvailabilityRequest $request) {
        //Get Request Data
        $requestData = $request->all();
        try {
            //Get product id
            $productId = $requestData['product_id'] ?? 0;
            //Get Dealer and product details
            if (!empty($productId)) {
                $product = Product::with(['dealer'])->where('id', $productId)->first();

                if (!empty($product['dealer']['email'])) {

                    $blade = 'checkAvailability';
                    $params = array();
                    $params['data'] = array();
                    $params['to'] = $product['dealer']['email'];
                    $params['subject'] = "Checking Vehicle Availability";
                    $params['data']['to_name'] = $product['dealer']['name'];
                    $params['data']['user-name'] = $requestData['first_name'] . ' ' . $requestData['last_name'];
                    $params['data']['user-phone'] = $requestData['phone'];
                    $params['data']['user-email'] = $requestData['email'];
                    $params['data']['user-comment'] = $requestData['comment'];
                    $params['data']['vehicle-year'] = $product['year'];
                    $params['data']['vehicle-make'] = $product['make'];
                    $params['data']['vehicle-model'] = $product['model'];
                    $params['data']['vehicle-trim'] = $product['trim'];
                    $params['data']['vehicle-mileage'] = $product['citympg'];
                    $params['data']['vehicle-vin'] = $product['vin'];

                    //Send mail
                    MailHelper::sendMail($params, $blade);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'status_code' => 500]);
        }        
        return response()->json(['status' => true, 'status_code' => 200]);
    }
    
    /**
     * This function is used to todays best price.
     * 
     * @param Request $request
     * @return Json $response
     * @author LY
     */
    public function requestTodayBestPrice(BestPriceRequest $request) {

        //Get Request Data
        $requestData = $request->all();
        try {
            //Get product id
            $productId = $requestData['product_id'] ?? 0;

            //Get Dealer and product details
            if (!empty($productId)) {
                $product = Product::where('id', $productId)->first();

                if (!empty($product['sellingprice']) && $product['sellingprice'] > 100) {

                    $message = 'Today\'s best price for the day is USD '.number_format(($product['sellingprice'] - 100), 2).'.';
                }
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Internal Server Error.', 'status_code' => 500]);
        }
        
        return response()->json(['status' => true, 'message' => $message, 'status_code' => 200]);
    }
	 public static function getMarketValue($vin,$sellingprice) {
		   try {
				$client = new Client();
				$response = $client->request('GET', 'http://marketvalue.vinaudit.com/getmarketvalue.php?key=RX0Y395X9YW8F79&vin='.$vin);
				$statusCode = $response->getStatusCode();
				$result = $response->getBody()->getContents();
				$prices =json_decode($result);
				$average=$prices->prices->average;
				$below=$prices->prices->below;
				$above=$prices->prices->above;

				if(($below-$sellingprice) > 3500 ){
					$deal="Rare Deal";
				}
				elseif($sellingprice < $below){
					$deal="Great Deal";
				}
				elseif($below < $sellingprice && $sellingprice < $average){
					$deal="Good Deal";
				}
				elseif($below < $average && $average < $sellingprice && $sellingprice < $above ){
					$deal="Fair Deal";
				}
				else{
					$deal=" ";
				}
			} catch (\Exception $e) {
				return false;
			}
				return $deal;
	  }
	  public static function gettrialClientStatus($delerid) {
		  
		$user = DB::table('dealer')->where('dealer_id',$delerid)->first();
		//echo "<pre>";print_r($user);die;
		 return $user;
	  }
}
