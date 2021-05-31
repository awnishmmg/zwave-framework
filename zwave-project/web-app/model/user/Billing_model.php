<?php

class Billing_model{

    public static function getUserBillingInfo($billing_id){
    global $chain;
    $chain = true;
    
    $relation_ship = [
      'tbl_user_billing'=>' tbl_user_billing.id=tbl_assigned_numbers.billing_id',
    ];
    
    $where = [
        'tbl_user_billing.id' => " ='{$billing_id}'",
    ];
    
    return fetch_records(where_this(inner_join("tbl_assigned_numbers=assigned_id as assign_id,procured_no_id as vn_id,user_id,status|tbl_user_billing=id as bill_id,billing_status,billing_name,activation_date,status as bstatus,billing_cost,billing_units,billing_channel_price,billing_channel_units,reseller_type,billing_address,city,town,state,account_type,need_hlr,hlr_cost,hlr_unit,gst",$relation_ship),$where));
    
    }



}