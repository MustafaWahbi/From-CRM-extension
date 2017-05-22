<?php



class magentoPush  {

    /****************Sending data by CURL******************/
    function send_data_by_curl($jsondata){

       var_dump($jsondata);
        die();
        $last='data='.$jsondata;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"http://34.251.204.49/custom");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$last);
        //$server_output = curl_exec ($ch); // if there is output
        curl_exec ($ch);
        curl_close ($ch);
    }
    /*** Update Contact ***/
    function UpdateMagentoContact($bean, $event, $arguments)
    {
        /********** sending data **************/
        $post_data= array(
            'address id'=>rawurlencode($bean->id)
        ,'account id'=>rawurlencode($bean->account_id)
        ,'first_name'=>rawurlencode($bean->first_name)
        ,'last_name'=>rawurlencode($bean->last_name)
        ,'email'=>rawurlencode($bean->email1)
        ,'phone_mobile'=>rawurlencode($bean->phone_mobile)
        ,'address_street'=>rawurlencode($bean->primary_address_street)
        ,'primary_address_city'=>rawurlencode($bean->primary_address_city)
        ,'primary_address_state'=>rawurlencode($bean->primary_address_state)
        ,'primary_address_postalcode'=>rawurlencode($bean->primary_address_postalcode)
        ,'primary_address_country'=>rawurlencode($bean->primary_address_country)
            //  ,'action'=>'update_order_address'
        ,'action'=>'update_customer_address'
        );
        $jsondata=json_encode($post_data);
        $base64_encode=base64_encode($jsondata);
        /*****send data*************/
        $this->send_data_by_curl($base64_encode);
        /*var_dump($jsondata);
        echo"<br><br>";
        var_dump($bean);*/
        //die()();

    }
    // var $module = 'Cases';
    function caseCreation($bean, $event, $arguments){
echo"close=".$bean->status;
        if($bean->status === 'Closed' )
        { //Closed
            $post_data= array(
                'id'=>rawurlencode($bean->kskorderid_c),
                'action'=>'order_status_closed'
            );
        }
        else if($bean->case_reasons_level1_c === 'A' )
        { //?????????????????????? on return request
            $post_data= array(
                'id'=>rawurlencode($bean->kskorderid_c),
                'action'=>'order_status_returned'
            );
        }
        else
        {
            $post_data= array(
                'id'=>rawurlencode($bean->kskorderid_c),
                'action'=>'order_status_pending'
            );
        }

        /********** sending data **************/
        /*$post_data= array(
            'id'=>rawurlencode($bean->id
        ,'name'=>rawurlencode($bean->name
       // ,'description'=>rawurlencode($bean->description
        ,'description'=>rawurlencode($bean->description)
        ,'status'=>rawurlencode($bean->status
        //,'resolution'=>rawurlencode($bean->resolution
        ,'resolution'=>rawurlencode($bean->resolution)
        ,'account id'=>rawurlencode($bean->account_id
        ,'state'=>rawurlencode($bean->state
         *,'account_id'=>rawurlencode($bean->account_id*
        ,'orderid_c'=>rawurlencode($bean->kskorderid_c
        ,'case_reasons_level_1'=>rawurlencode($bean->case_reasons_level1_c
        ,'case_reasons_level_2'=>rawurlencode($bean->case_reasons_level2_c
        ,'item_id'=>rawurlencode($bean->skuid_c
        ,'action'=>'case_creation'
        );*/

        $jsondata=json_encode($post_data);
        $base64_encode=base64_encode($jsondata);
        /*****send data*************/
        $this->send_data_by_curl($base64_encode);
    }
    //lineItemUpdate
    function orderUpdate($bean, $event, $arguments){
        if ($bean->fetched_row['contact_id_c'] !== $bean->contact_id_c) {
            /* Create contact object to get address details using address id (contact id)*/
            $focus = new Contact();
            $focus->retrieve($bean->contact_id_c);
            $post_data= array(
                'address_id'=>rawurlencode($bean->contact_id_c)
            ,'order_id'=>rawurlencode($bean->id)
            ,'first'=>rawurlencode($focus->first_name)
            ,'last'=>rawurlencode($focus->last_name)
            ,'email'=>rawurlencode($focus->email1)
            ,'phone'=>rawurlencode($focus->phone_mobile)
            ,'street'=>rawurlencode($focus->primary_address_street)
            ,'city'=>rawurlencode($focus->primary_address_city)
            ,'state'=>rawurlencode($focus->primary_address_state)
            ,'postalcode'=>rawurlencode($focus->primary_address_postalcode)
            ,'country'=>rawurlencode($focus->primary_address_country)
            ,'action'=>'update_order_address'
            );
        }
        else if(($bean->fetched_row['ksk05_orderstatus'] !== $bean->ksk05_orderstatus)&&($bean->ksk05_orderstatus == 5)){
            //ksk05_orderstatus = Cancelled
            $post_data= array(
                'order_id'=>rawurlencode($bean->id),
                'action'=>'order_cancel'
            );}
        /************/
        else if(($bean->fetched_row['orderconfirmed_c'] !== $bean->orderconfirmed_c)&&($bean->orderconfirmed_c == 1)){
            $post_data= array(
                'order_id'=>rawurlencode($bean->id),
                'action'=>'order_confirmed'
            );
        }
        else{
            $post_data= array(
                'order_id'=>rawurlencode($bean->id),
                'action'=>'No updates'
            );
        }

        // echo 'all contact_id_c='.$bean->contact_id_c.'- orderstatus'.$bean->ksk05_orderstatus.'- confirm '.$bean->orderconfirmed_c;



        /********** sending data **************/
        /* $post_data= array(
             'id'=>rawurlencode($bean->id
             ,'orderid'=>rawurlencode($bean->ksk05_kskorderid
             ,'account_id_c'=>rawurlencode($bean->account_id_c
             ,'orderstatus'=>rawurlencode($bean->ksk05_orderstatus
             ,'confimed_status'.$bean->orderconfirmed_c
             ,'address_id'=>rawurlencode($bean->contact_id_c
             ,'action'=>'update_order'
         );*/
        /*echo('<br>address'.$bean->fetched_row['contact_id_c'] .'!=='. $bean->contact_id_c);
        echo('<br>order status'.$bean->fetched_row['ksk05_orderstatus'] .'!== '.$bean->ksk05_orderstatus);
        echo('<br>order confirm'.$bean->fetched_row['orderconfirmed_c'] .'!=='. $bean->orderconfirmed_c);*/



        $jsondata=json_encode($post_data);
        $base64_encode=base64_encode($jsondata);
        /*****send data*************/
        $this->send_data_by_curl($base64_encode);
        /*****send data*************/
        //var_dump($jsondata);
        // print_r($jsondata);
        //die()();
    }
    //lineItemUpdate
    function lineItemUpdate($bean){

        /********** sending data **************/
        if($bean->product_qty == 0){
            $post_data= array(
                'id'=>rawurlencode($bean->id),
                'order_id'=>rawurlencode($bean->ksk05_header3_id_c),
                'action'=>'line_item_cancel'
            );
        }
        else{
            $post_data= array(
                'id'=>rawurlencode($bean->id),
                'order_id'=>rawurlencode($bean->ksk05_header3_id_c),
                'quantity'=>rawurlencode($bean->product_qty),
                'action'=>'line_item_update_quantity'
            );
        }
        /*$post_data= array(
            'id'=>rawurlencode($bean->id
            //,'product_id'=>rawurlencode($bean->product_id
            ,'orderid'=>rawurlencode($bean->ksk05_header3_id_c
            ,'name'=>rawurlencode($bean->name
            ,'quantity'=>rawurlencode($bean->product_qty
            ,'product_cost_price'=>rawurlencode($bean->product_cost_price
            ,'product_list_price'=>rawurlencode($bean->product_list_price
            ,'vat'=>rawurlencode($bean->vat
            ,'vat_amount'=>rawurlencode($bean->vat_amt
            ,'product_unit_price'=>rawurlencode($bean->product_unit_price

            ,'product_total_price'=>rawurlencode($bean->product_total_price
        ,'action'=>'update_line_item'
        );*/
//        var_dump($bean->ksk05_header3_id_c);
        $jsondata=json_encode($post_data);
        $base64_encode=base64_encode($jsondata);
        /*****send data*************/
        $this->send_data_by_curl($base64_encode);
        //die()();

    }

}
?>
