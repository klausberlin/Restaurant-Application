<?php

namespace Application\Model;


class KitchenMethod
{
    private $data;

    public function __construct(DataModel $data)
    {
        $this->data = $data;
    }

    public function allOpenOrders()
    {
        $openFoodOrders = $this->data->getAllFoodorders();

        foreach($openFoodOrders as $foodOrders){

            $foodOrderId[] = $foodOrders['order_id'];

        }
        $return = $openFoodOrders;
        return $return;
    }


}