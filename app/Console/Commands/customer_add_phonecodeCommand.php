<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class customer_add_phonecodeCommand extends Command
{
    protected $signature = 'customer:add-phonecode';

    protected $description = 'Command description';

    public function handle()
    {
        $customers = \App\Models\CrmCustomer::all();
        foreach ($customers as $customer) {
            $phone = $customer->phone;
            if (strlen($phone) == 10) {
                $phone = '1' . $phone;
            }
            $customer->phone = $phone;
            $customer->save();
        }
        echo 'Done';
    }
}
