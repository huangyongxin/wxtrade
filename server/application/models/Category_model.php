<?php

class Category_model extends CI_Model
{

    public function findAll()
    {
        $sql = "SELECT * FROM Category WHERE parent is NULL ";
        $categoris = $this->db->query($sql)->result();
        foreach ($categoris as $category) {
            $sql_son="SELECT * FROM Category WHERE parent = ". $category->id;


            $children =$this->db->query($sql_son)->result();
            // 不必使用转数组再动态添加成员属性，$category = $category->toJSON();object同样可以实现操作
            $category->children = $children;
            $result[] = $category;

        }
        return  $result;

    }
    public function delete($objectId) {
       return  $this->db->delete('user',array('id'=>$objectId));
    }

    public function findInfo($objectId)
    {
        $sql = "SELECT * FROM Category WHERE id is  ".$objectId;
        return $this->db->query($sql)->row();
    }



    /*
     * 根据多个条件获得数据
     */
    public function get_list($wheresql,$field='*',$limit=-1,$orderby='')
    {
        if (count($wheresql) == 0) {
            return array();
        }

        $sql = "SELECT " . $field . " FROM Category WHERE ";

        foreach ($wheresql as $key => $val ) {
            if (isset($key) && (0 < strlen($key))) {
                $sql .= $key;
            }

            if (isset($val) && (0 < strlen($val))) {
                $sql .= $this->db->escape($val);
            }
        }

        if ($orderby != "") {
            $sql .= " order by " . $orderby;
        }

        if ($limit != -1) {
            $sql .= " limit " . $limit;
        }

        $query = $this->db->query($sql);
        return $query->result();
    }

}