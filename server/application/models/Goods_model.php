<?php

class Goods_model extends CI_Model
{
    public function getOne($id)
    {
        $sql="select * from goods where id= {$id}";
        return $this->db->query($sql)->row();
    }

    public function delete($objectId)
    {
        $this->db->where('id', $objectId);
        $this->db->delete('goods');
        return ($this->db->affected_rows()?true:false);
    }




}