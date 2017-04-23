<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 23.04.2017
 * Time: 12:20
 */

class DealHelper extends AppHelper
{
    public function getHtmlStatus($status)
    {
        $textStatus = '';
        $alertClass = '';

        switch ($status) {
            case '0':
                $textStatus = 'Waiting for partner';
                $alertClass = 'label-default';
                break;
            case '1':
                $textStatus = 'Reserving money';
                $alertClass = 'label-info';
                break;
            case '2':
                $textStatus = 'Money reserved, waiting for sending product';
                $alertClass = 'label-primary';
                break;
            case '3':
                $textStatus = 'Product has been sent. Waiting for receiving';
                $alertClass = 'label-primary';
                break;
            case '4':
                $textStatus = 'Successfully';
                $alertClass = 'label-success';
                break;
            case '5':
                $textStatus = 'Canceled by partner';
                $alertClass = 'label-danger';
                break;
            case '6':
                $textStatus = 'Consideration of arbitration';
                $alertClass = 'label-warning';
                break;
            case '7':
                $textStatus = 'Decision of arbitration in favor of the buyer';
                $alertClass = 'label-warning';
                break;
            case '8':
                $textStatus = 'Decision of arbitration in favor of the seller';
                $alertClass = 'label-warning';
                break;
        }

        $html = "<span class='label {$alertClass}'>{$textStatus}</span>";

        return $html;
    }

    public function getHtmlStatusBar($status)
    {
        $statuses = array(
            '0' => array(
                'liClass' => '',
                'title' => 'Waiting for partner',
                'icon' => 'fa-user'
            ),
            '1' => array(
                'liClass' => '',
                'title' => 'Reserving money',
                'icon' => 'fa-money'
            ),
            '2' => array(
                'liClass' => '',
                'title' => 'Money reserved, waiting for sending product',
                'icon' => 'fa-paper-plane'
            ),
            '3' => array(
                'liClass' => '',
                'title' => 'Product has been sent. Waiting for receiving',
                'icon' => 'fa-gift'
            ),
            '4' => array(
                'liClass' => '',
                'title' => 'Successfully',
                'icon' => 'fa-check'
            ),
        );

        for ($i = 0; $i < $status && $i < count($statuses); $i++) {
            $statuses[$i]['liClass'] = 'completed';
        }
        
        switch ($status) {
            case '0':
                $statuses['0']['liClass'] = 'active';
                break;
            case '1':
                $statuses['1']['liClass'] = 'active';
                break;
            case '2':
                $statuses['2']['liClass'] = 'active';
                break;
            case '3':
                $statuses['3']['liClass'] = 'active';
                break;
            case '4':
                $statuses['4']['liClass'] = 'active';
                break;
            case '5':
                $statuses['4']['liClass'] = 'active red';
                $statuses['4']['icon'] = 'fa-times';
                $statuses['4']['title'] = 'Canceled by partner';
                
                break;
            case '6':
                $statuses['4']['liClass'] = 'active orange';
                $statuses['4']['icon'] = 'fa-eye';
                $statuses['4']['title'] = 'Consideration of arbitration';
                break;
            case '7':
                $statuses['4']['liClass'] = 'active orange';
                $statuses['4']['icon'] = 'fa-check';
                $statuses['4']['title'] = 'Decision of arbitration in favor of the buyer';
                break;
            case '8':
                $statuses['4']['liClass'] = 'active orange';
                $statuses['4']['icon'] = 'fa-check';
                $statuses['4']['title'] = 'Decision of arbitration in favor of the seller';
                break;
        }

        $html = '';

        foreach ($statuses as $item) {
            $html .= $item['liClass'] ? "<li class='{$item['liClass']}'>" : "<li>";
            $html .= "<a href=\"javascript:void(0)\" data-toggle=\"tab\" title=\"{$item['title']}\">";
            $html .= "<span class=\"round-tabs\">";
            $html .= "<i class=\"fa {$item['icon']}\"></i>";
            $html .= "</span>";
            $html .= "</a>";
            $html .= "</li>";
        }

        return $html;
    }
}