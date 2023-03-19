<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Macoui;

class UploadMacOuiCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mac_oui:upload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload latest Oui database';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $output = file_get_contents('http://standards-oui.ieee.org/oui/oui.csv');
        $output = explode(PHP_EOL, $output);
        if(count($output) > 2){

            Macoui::truncate();
                
            $c = 0;
        
            foreach($output as $row){ 
                if($c > 0){ 
                    // Skip the first row            
                    // 0 = Registry            
                    // 1 = Assignment            
                    // 2 = Org Name            
                    // 3 = Org Address            
                    
                    $csv = str_getcsv($row);
        
                    // If $csv doesn't have 4 indexes then we can't insert this oui, also something was likely off with the previous entry.            
                    if(count($csv) == 4){
                        $registry = $csv[0];            
                        $oui = $csv[1];
                        $orgName = $csv[2];
                        $orgAddress = $csv[3];

                        Macoui::create([
                            'registry' => $registry,
                            'oui' => $oui,
                            'organization_name' => $orgName,
                            'organization_address' => $orgAddress,
                        ]);
                     }   
                }
                
                $c++;
            }
        }
        
        $this->info(string: 'success');
    }
}
