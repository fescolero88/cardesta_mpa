<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    public $filename;
    public $fields;

    public function __construct()
    {
        $this->filename = base_path('/database/seeds/csvs/RalphSchompMINI.csv');
        $this->getHeaders();
    }

    public function getHeaders()
    {
        $csv = array_map("str_getcsv", file($this->filename,FILE_SKIP_EMPTY_LINES));
        $keys = array_shift($csv);
        $keys = array_map("strtolower", $keys);
        $this->fields = array_map("snake_case", $keys);
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $skip_fields = [
            'dealer_address',
            'dealer_city',
            'dealer_state',
            'dealer_zip',
            'dealer_phone',
            'dealer_fax',
            'special_field1',
            'special_field2',
            'special_field3',
            'special_field4',
            'misc_price1',
            'misc_price2',
            'misc_price3',
            'imagelist',
            'options',
            'categorized_options',
        ];

        $fields = $this->fields;
        Schema::create('products', function (Blueprint $table) use($fields,$skip_fields) {
            $table->increments('id');
            foreach($fields as $field)
            {
                if(in_array($field,$skip_fields)) continue;

                if($field == 'description') 
                    $table->text($field)->nullable();
                else if(preg_match("/\date\b/i", $field)) 
                    $table->date($field)->nullable();
                else    
                    $table->string($field)->nullable();
            }
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
