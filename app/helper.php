<?php
    function price($price, $value = '', $pos = '', $check_dot = '')
    {
        if ($value) {

            $dot = 0;

            if ($check_dot) {
               $dot = $check_dot;
            }

            if ($pos) {
               return $value.''.number_format($price, $dot);
            }
            return number_format($price, $dot).''.$value;
        }
        return number_format($price, 0).' ₫';
    }

    function product_price($price) {
        $symbol = '₫';
        $symbol_thousand = ',';
        $decimal_place = 0;
        $price = number_format($price, $decimal_place, '', $symbol_thousand);
        return $price.$symbol;
    }
    
    function product_price_view($price) {
        $symbol_thousand = ',';
        $decimal_place = 0;
        $price = number_format($price, $decimal_place, '', $symbol_thousand);
        return $price;
    }

    function proParent ($data, $parent = 0, $str = "—", $select = 0) {
        foreach ($data as $value) {
            $id = $value->id;
            $name = $value->name;
            if ($value->parent_id == $parent) {
                if ($select != 0 && $id = $select) {
                    echo "<option value='$id' selected='selected'>$str $name</option>";
                }else {
                    echo "<option value='$id'>$str $name</option>";
                } 
                proParent ($data, $id, $str."—");
            }
        }
    }
    // menu 1 cap
    // function proParent ($data) {
    //     foreach ($data as $key => $value) {
    //         $id = $value->id;
    //         $name = $value->name;
    //         echo "<option>$name</option>";
    //     }
    // }
    // end menu 1 cap

    function recursive ($categories, $parent_id = 0) {
        $cate_child = array();
        foreach ($categories as $key => $item) {
            if ($item['parent_id'] == $parent_id) {
                $cate_child[] = $item;
                unset($categories[$key]);
            }
        }

        if ($cate_child) {
            echo '<ul class="submenu">';
            foreach($cate_child as $item) {
                $check = DB::table('productcategories')->where('parent_id',$item["id"])->count();
                $hasChild = ($check <= 0) ? '' : 'class="has-children"';
                echo '<li '.$hasChild.'>';
                    echo '<a href="'.route('frontend.categories',['slug' => $item["slug"]]).'"><span>'.$item["name"].'</span>';
                    echo '</a>';
                    recursive ($categories, $item["id"]);
                echo '</li>';
            }
            echo '</ul>';
        
        }
    }

    function recursiveCheckbox ($categories,$data_checked = array(),$parent_id = 0,$stt = 0) {
        $cate_child = array();
        foreach ($categories as $key => $item) {
            if ($item['parent_id'] == $parent_id) {
                $cate_child[] = $item;
                unset($categories[$key]);
            }
        }

        if ($cate_child) {
            if ($stt == 0) {
                echo '<ul style="padding-left:0px">';
            } else {
                echo '<ul style="padding-left:20px">';
            }
            
            foreach($cate_child as $item) {
                echo '<li>';
                    $checked = in_array($item["id"], $data_checked) ? 'checked' : '';
                    echo '<input '.$checked.' type="checkbox" name="productcategories_id[]" value="'.$item["id"].'" /> '.$item["name"];
                    recursiveCheckbox ($categories,$data_checked, $item["id"],++$stt);
                echo '</li>';
            }
            echo '</ul>';
        
        }
    }

    function recursveTable ($data,$parent_id = 0,$char = "") {
        foreach ($data as $productcategory) {
            if ($productcategory->parent_id == $parent_id) {
                echo '<tr>';
                echo '<td>';
                echo '<label>';
                echo '<input type="checkbox" class="checkbox" data-id="'.$productcategory->id.'">';
                echo '</label>';
                echo '</td>';
                echo '<td>'.$productcategory->stt.'</td>';
                echo '<td style="text-align: left;"><strong><a href="'.route('backend.productcategory.edit', $productcategory->id).'">'.$char.$productcategory->name.'</a></strong></td>';
                echo '<td>'.date("d/m/Y", strtotime($productcategory->updated_at)).'</td>';
                echo '<td>';
                
                if($productcategory->hide_show == 1) {
                    echo '<div class="form-group">';
                    echo '<div class="form-group has-success">';
                    echo '<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i></label>';
                    echo '</div>';
                    echo '</div>';
                } else {
                    echo '<div class="form-group has-error">';
                    echo '<label class="control-label" for="inputError"><i class="fa fa-times"></i></label>';
                    echo '</div>';
                }
                
                echo '</td>';
                echo '<td>';
                echo '<div class="'.(($productcategory->status == 'Published') ? 'badge bg-green' : 'badge bg-red').'">';

                if ($productcategory->status == 'Published') {
                    echo 'Xuất bản';
                } else {
                    echo "Chờ duyệt";
                }

                echo '</div>';
                echo '</td>';
                echo '<td>';
                echo '<a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Sửa danh mục" href="'.route('backend.productcategory.edit', $productcategory->id ).'"><i class="fa fa-edit"></i></a>';
                echo '<form method="POST" action="'.route('backend.productcategory.destroy', $productcategory->id).'" onclick="return confirm(\'Xác nhận Xóa ?\')" style="display: inline;">';
                echo '<input type="hidden" name="_token" value="'.csrf_token().'">';
                echo '<input type="hidden" name="_method" value="DELETE">';
                echo '<button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Xoá danh mục"><i class="fa fa-trash"></i></button>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';

                recursveTable ($data,$productcategory["id"],$char."—");
            }
        }
    }

    function breadcrumb ($slug) {
        $data_breadcrumb_current = DB::table('productcategories')->where("slug",$slug)->first();
        return $data_breadcrumb_current->id;
    }

    function breadcrumb_auto ($id, &$data) {
        $parent_id = DB::table('productcategories')->where('id',$id)->value('parent_id');
        $data[] = $parent_id;
        breadcrumb_auto ($parent_id, $data);
    }

    function getCategoryTreeIDs($catID) {
        $row = DB::table('productcategories')->where('id',$catID)->first();
        $path = array();
        if (!$row->parent_id == '') {
            $path[] = $row->parent_id;
            $path = array_merge(getCategoryTreeIDs($row->parent_id), $path);
        }
        return $path;
    }


    function getNewCategoryTreeIDs($newCatID) {
        $row = DB::table('newcategories')->where('id',$newCatID)->first();
        $path = array();
        if (!$row->parent_id == '') {
            $path[] = $row->parent_id;
            $path = array_merge(getNewCategoryTreeIDs($row->parent_id), $path);
        }
        return $path;
    }

    function getProjectTreeIDs($projectID) {
        $row = DB::table('projects')->where('id',$projectID)->first();
        $path = array();
        if (!$row->parent_id == '') {
            $path[] = $row->parent_id;
            $path = array_merge(getProjectTreeIDs($row->parent_id), $path);
        }
        return $path;
    }

    function deleteMultiLevel($data,$parent_id) {
        $path = array();
        foreach ($data as $productcategory) {
            if ($productcategory->parent_id == $parent_id) {
                $path[] = $productcategory->id;
                $path = array_merge(deleteMultiLevel($data,$productcategory->id), $path);
            }
        }
        return $path;
    }
    function imageUrl($path,$width = NULL,$height = NULL,$quality=NULL,$crop=NULL, $thumb=5) {
        if(!$width && !$height) {
            $url = env('IMAGE_URL') . $path;
        } else {
            $url = url('/') . '/timthumb.php?src=' . env('IMAGE_URL') . $path;

            if(isset($width)) {
                $url .= '&w=' . $width; 
            }

            if(isset($height) && $height>0) {
                $url .= '&h=' .$height;
            }
            if(isset($crop))
            {
                $url .= "&zc=".$crop;
            }
            else
            {
                $url .= "&zc=1";
            }

            if(isset($quality))
            {
                $url .='&q='.$quality.'&s=1';
            }
            else
            {
                $url .='&q=95&s=1';
            }
        }
        $file_name = basename(formatImage ($path, $width, $height)); 
        if (!file_exists(public_path()."/frontend/thumb/".$file_name)) {
            if(file_put_contents(public_path()."/frontend/thumb/".$file_name,file_get_contents($url))) { 
                return asset("/frontend/thumb/".$file_name); 
            } else {
                return "Error";
            }
        } else {
            return asset("/frontend/thumb/".$file_name); 
        }
    }
    function formatImage ($filename, $width, $height) {
        $part_filename = explode(".", $filename);
        $file_name_origin = $part_filename[0];
        return str_replace($file_name_origin, $file_name_origin."-".$width."x".$height, $filename);
    }
    function imageUrlBackend($path,$width = NULL,$height = NULL,$quality=NULL,$crop=NULL) {
        if(!$width && !$height) {
            $url = env('IMAGE_URL') . $path;
        } else {
            $url = url('/') . '/timthumb.php?src=' . env('IMAGE_URL') . $path;

            if(isset($width)) {
                $url .= '&w=' . $width; 
            }

            if(isset($height) && $height>0) {
                $url .= '&h=' .$height;
            }
            if(isset($crop))
            {
                $url .= "&zc=".$crop;
            }
            else
            {
                $url .= "&zc=1";
            }

            if(isset($quality))
            {
                $url .='&q='.$quality.'&s=1';
            }
            else
            {
                $url .='&q=95&s=1';
            }
        }
        $file_name = basename(formatImageBackend($path, $width, $height)); 
        if (!file_exists(public_path()."/backend/thumb/".$file_name)) {
            if(file_put_contents(public_path()."/backend/thumb/".$file_name,file_get_contents($url))) { 
                return asset("/backend/thumb/".$file_name); 
            } else {
                return "Error";
            }
        } else {
            return asset("/backend/thumb/".$file_name); 
        }
    }
    function formatImageBackend($filename, $width, $height) {
        $part_filename = explode(".", $filename);
        $file_name_origin = $part_filename[0];
        return str_replace($file_name_origin, $file_name_origin."-".$width."x".$height, $filename);
    }
    function recursiveSelect($data, int $parent_id = 1, &$array = array())
    {
        foreach ($data as $key => $item) {
            if ($item->parent_id == $parent_id) {
                $array[] = $item->id;
                unset($data[$key]);

                recursiveSelect($data, $item->id, $array);
            }
        }
    }