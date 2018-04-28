<?php

class Order_model extends CI_Model
{
    public function pages($per_page,$pageIndex)
    {
        $sql="select * from orders JOIN user ON  user.id = orders.userId JOIN address.id = orders.addressId limit ".($per_page-1)*$pageIndex.' , '.$pageIndex .' order by createdAt';
        return $this->db->query($sql)->result();
    }

    public function totalCount()
    {
        return  $this->db->count_all('orders');
    }

    public function changeStatus($objectId, $status)
    {
        $sql ="update orders set  status = {$status} where id ={$objectId} ";
        $query=$this->db->query($sql);
        return ($this->db->affected_rows()?true:false);
    }
}