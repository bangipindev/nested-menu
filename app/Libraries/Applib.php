<?php

namespace App\Libraries;

use App\Models\Admin\ArticleCategory;
use App\Models\Admin\Menu;
use App\Models\Admin\MenuItem;
use App\Models\Admin\Page;
use Illuminate\Support\Facades\DB;

class Applib
{
    /******************* MENU  ***********************/
    public static function select($name = "menu", $menulist = array())
    {
        $html = '<select name="' . $name . '">';

        foreach ($menulist as $key => $val) {
            $active = '';
            if (request()->input('menu') == $key) {
                $active = 'selected="selected"';
            }
            $html .= '<option ' . $active . ' value="' . $key . '">' . $val . '</option>';
        }
        $html .= '</select>';
        return $html;
    }

    public static function getByName($name)
    {
        $menu = Menu::byName($name);
        return is_null($menu) ? [] : self::get($menu->id);
    }

    public static function get($menu_id)
    {
        $menuItem = new MenuItem();
        $menu_list = $menuItem->getall($menu_id);

        $roots = $menu_list->where('menu', (int) $menu_id)->where('parent', 0);

        $items = self::tree($roots, $menu_list);
        return $items;
    }

    private static function tree($items, $all_items)
    {
        $data_arr = array();
        $i = 0;
        foreach ($items as $item) {
            $data_arr[$i] = $item->toArray();
            $find = $all_items->where('parent', $item->id);

            $data_arr[$i]['child'] = array();

            if ($find->count()) {
                $data_arr[$i]['child'] = self::tree($find, $all_items);
            }

            $i++;
        }

        return $data_arr;
    }

    public static function menupage()
    {
        $querypages     = Page::orderBy('id', 'ASC')->get();
        foreach ($querypages as $pages) {
            echo "<tbody>
                <td>
                    $pages->name
                </td>
                <td align='center'>
                    <a  href='#' data-url='$pages->slug' data-title='$pages->name' data-opsi='1' class='button-secondary tambahkan-ke-menu right'>Tambah<i class='fa fa-sign-out'></i> </a>
                    <span class='spinner' id='spinkategori'></span>
                 </td>
            </tbody>";
        }
    }
    public static function menukategori()
    {
        // $query     = ArticleCategory::where('parent','=','1')->get();
        $query     = ArticleCategory::get();
        foreach ($query as $pages) {
            echo "<tbody>
                <td>
                    $pages->name
                </td>
                <td align='center'>
                    <a href='#' data-url='artikel/$pages->slug' data-title='$pages->name' class='button-secondary tambahkan-ke-menu right'>Tambah<i class='fa fa-sign-out'></i> </a>
                    <span class='spinner' id='spinkategori'></span>
                 </td>
            </tbody>";
        }
    }
    public static function WebMenu($id)
    {
        $menu            = Menu::where('id', $id)->with('items')->first();
        $public_menu     = $menu->items;
        return $public_menu;
    }
}
