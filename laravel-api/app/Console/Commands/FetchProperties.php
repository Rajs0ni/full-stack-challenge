<?php

namespace App\Console\Commands;

use App\Sk\SkPayload;
use Illuminate\Console\Command;
use App\Sk\Property\PropertyApi;
use Illuminate\Support\Facades\Http;
use App\Sk\PropertyType\PropertyTypeApi;

class FetchProperties extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:properties';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to fetch properties data from 3rd party API';

    public $propertyBaseApiUrl;
    public $propertyApiKey;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->propertyBaseApiUrl = config('app.property_api_url');
        $this->propertyApiKey = config('app.property_api_key');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->fetchProperties();
    }

    public function fetchProperties()
    {
        $currentPage = 1;
        $apiUrl = $this->propertyBaseApiUrl."/api/properties?api_key=".$this->propertyApiKey;
        $apiUrl .= "&page[number]=$currentPage";

        try {
            do {
                $this->info("Started for page ===> $currentPage".PHP_EOL);
                $response = Http::get($apiUrl);
                if($response->failed()){
                    exit();
                }
                $result = $response->object();
                $currentPage += $result->current_page;

                $properties = $result->data;

                foreach ($properties as $property) {
                    $propertyTypePayload = new SkPayload($property->property_type);
                    $propertyType = PropertyTypeApi::firstOrNew($propertyTypePayload);

                    $propertyPayload = new SkPayload($property);
                    $propertyPayload->property_type_id = $propertyType->id;
                   
                    $property = PropertyApi::findByUuid($propertyPayload->uuid);
                    
                    if(empty($property)){
                        // Create new record
                        $property = PropertyApi::create($propertyPayload);
                    }else{
                        if(!$property->is_admin_entry){
                            // Update iff admin didn't make any changes in it
                            $propertyPayload->id = $property->id;
                            $property = PropertyApi::update($propertyPayload, $property);
                        }
                    }
                    $this->info("Processed ===> $property->uuid".PHP_EOL);
                }
            }
            while ($currentPage != $result->last_page);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
