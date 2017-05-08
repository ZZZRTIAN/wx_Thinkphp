<?php
/**
 * author: speechx-rtzhang
 * Date: 2017/5/8
 * Time: 11:55
 */
namespace Common\kit;
Class Page
{
    /**
     * @param int $recordCount
     * @param int $pageSize
     * @param int $currentPage
     * @param string $paras
     * @return string
     */
    public static function page($recordCount,$pageSize,$currentPage,$paras="")
    {
        $recordCount = intval($recordCount);
        $pageSize = intval($pageSize);
        $currentPage = intval($currentPage);

        $pageCount = ceil($recordCount / $pageSize);

        if ($currentPage > $pageCount) {
            $currentPage = $pageCount;
        }

        if ($currentPage < 1) {
            $currentPage = 1;
        }

        $prePage = $currentPage - 1;
        $nextPage = $currentPage + 1;

        $total_html = '<div class="col-sm-6">
                            <div class="dataTables_info" id="editable_info" role="alert" aria-live="polite" aria-relevant="all">共 '. $recordCount .' 项
                            </div>
                     </div>';

        $page_html = '<div class="col-sm-6">
                            <div class="dataTables_paginate paging_simple_numbers" id="editable_paginate">
                                <ul class="pagination">';

        //首页
        if ($currentPage - 2 <= 1 || $pageCount < 10) {

            $page_html .= '<li class="paginate_button previous disabled" aria-controls="editable" tabindex="0" id="editable_previous">
                                        <a href="javascript:void(0);">«</a>
                                    </li>';
        }
        else {
            $page_html .= '<li class="paginate_button previous" aria-controls="editable" tabindex="0" id="editable_previous">
                                        <a href="?page=1' . '&page_size=' . $pageSize . $paras .'">«</a>
                                    </li>';
        }

        //上一页
        if ($prePage < 1) {
            $page_html .= '<li class="paginate_button previous disabled" aria-controls="editable" tabindex="0" id="editable_previous">
                                        <a href="javascript:void(0);">‹</a>
                                    </li>';
        }
        else {
            $page_html .= '<li class="paginate_button previous" aria-controls="editable" tabindex="0" id="editable_previous">
                                        <a href="?page=' . $prePage . '&page_size=' . $pageSize . $paras .'">‹</a>
                                    </li>';
        }

        //中间页
        if($pageCount <= 10) {

            for($i = 1; $i <= $pageCount ; $i++) {

                if ($currentPage == $i) {
                    $page_html .= '<li class="paginate_button previous active" aria-controls="editable" tabindex="0" id="editable_previous">
                                        <a href="javascript:void(0);">' . $i .'</a>
                                    </li>';
                }
                else{
                    $page_html .= '<li class="paginate_button previous" aria-controls="editable" tabindex="0" id="editable_previous">
                                        <a href="?page=' . $i . '&page_size=' . $pageSize . $paras. '">' . $i .'</a>
                                    </li>';
                }
            }
        }
        else {

            if($currentPage + 7 <= $pageCount) {//当前页面+7是否大于总页面

                if($currentPage > 3) {//从第四页开始，显示当前页面的前2页和后7页

                    for($i = $currentPage - 2 ; $i <= $currentPage + 7 ; $i++)
                    {
                        if ($currentPage == $i) {
                            $page_html .= '<li class="paginate_button previous active" aria-controls="editable" tabindex="0" id="editable_previous">
                                        <a href="javascript:void(0);">' . $i .'</a>
                                    </li>';
                        } else {
                            $page_html .= '<li class="paginate_button previous" aria-controls="editable" tabindex="0" id="editable_previous">
                                        <a href="?page=' . $i . '&page_size=' . $pageSize . $paras. '">' . $i .'</a>
                                    </li>';
                        }
                    }
                }
                else {//当前页为前3页，只显示10页

                    for($i = 1 ; $i <= 10 ; $i++) {
                        if ($currentPage == $i) {
                            $page_html .= '<li class="paginate_button previous active" aria-controls="editable" tabindex="0" id="editable_previous">
                                        <a href="javascript:void(0);">' . $i .'</a>
                                    </li>';
                        }else{
                            $page_html .= '<li class="paginate_button previous" aria-controls="editable" tabindex="0" id="editable_previous">
                                        <a href="?page=' . $i . '&page_size=' . $pageSize . $paras. '">' . $i .'</a>
                                    </li>';
                        }
                    }
                }

            }
            else {//末10页

                for($i=$pageCount-10;$i<=$pageCount;$i++) {

                    if ($currentPage == $i) {
                        $page_html .= '<li class="paginate_button previous active" aria-controls="editable" tabindex="0" id="editable_previous">
                                        <a href="javascript:void(0);">' . $i .'</a>
                                    </li>';
                    }
                    else {
                        $page_html .= '<li class="paginate_button previous" aria-controls="editable" tabindex="0" id="editable_previous">
                                        <a href="?page=' . $i . '&page_size=' . $pageSize . $paras. '">' . $i .'</a>
                                    </li>';
                    }
                }

            }

        }

        //下一页
        if ($nextPage >= $pageCount) {
            $page_html .= '<li class="paginate_button previous disabled" aria-controls="editable" tabindex="0" id="editable_previous">
                                        <a href="javascript:void(0);">›</a>
                                    </li>';
        }
        else {
            $page_html .= '<li class="paginate_button previous" aria-controls="editable" tabindex="0" id="editable_previous">
                                        <a href="?page=' . $nextPage . '&page_size=' . $pageSize . $paras .'">›</a>
                                    </li>';
        }

        //末页
        if($pageCount <= 10 || $pageCount - $currentPage < 8) {
            $page_html .= '<li class="paginate_button previous disabled" aria-controls="editable" tabindex="0" id="editable_previous">
                                        <a href="javascript:void(0);">»</a>
                                    </li>';
        }
        else {
            $page_html .= '<li class="paginate_button previous" aria-controls="editable" tabindex="0" id="editable_previous">
                                        <a href="?page=' . $pageCount . '&page_size=' . $pageSize . $paras .'">»</a>
                                    </li>';
        }


        $page_html .= '</ul></div></div>';
        return $total_html . $page_html;
    }
}