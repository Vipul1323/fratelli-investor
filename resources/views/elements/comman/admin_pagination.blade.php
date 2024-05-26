<?php
// config
$link_limit = 6; // maximum number of links (a little bit inaccurate, but will be ok for now)

//Append sort and order
$sort_order = '&sort='.$sort.'&order='.$order;
?>

<div class="row">
    <div class="col-sm-4 text-muted"> {{ $paginator->total().' Total '.$module }}</div>
    <div class="col-sm-8 text-right">
	    <ul class="pagination margin-none">
	        <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
	            <a class="paginate-link" href="javascript:void(0);" data-href="{{ $paginator->url(1).$sort_order }}">First</a>
	         </li>
	        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
	            <?php
	            $half_total_links = floor($link_limit / 2);
	            $from = $paginator->currentPage() - $half_total_links;
	            $to = $paginator->currentPage() + $half_total_links;
	            if ($paginator->currentPage() < $half_total_links) {
	               $to += $half_total_links - $paginator->currentPage();
	            }
	            if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
	                $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
	            }
	            ?>
	            @if ($from < $i && $i < $to)
	                <li class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
	                    <a class="paginate-link" href="javascript:void(0);" data-href="{{ $paginator->url($i).$sort_order }}">{{ $i }}</a>
	                </li>
	            @endif
	        @endfor
	        <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
	            <a class="paginate-link" href="javascript:void(0);" data-href="{{ $paginator->url($paginator->lastPage()).$sort_order }}">Last</a>
	        </li>
	    </ul>
	</div>
</div>