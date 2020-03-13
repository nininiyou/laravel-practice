@extends('layout/nav')

@section('css')

<style>
    ul {
        margin: 0;
        padding: 0;
    }

    li {
        list-style: none;
    }

    p {
        margin: 0;
        padding: 0;
    }


    .container {
        padding: 100px 0;
    }

    .product-info {
        flex-grow: 1;
        width: 100%;
        overflow: hidden;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        margin-top: 8px;
        margin-bottom: -4px;
    }

    .product__section-spacer {
        border-bottom: 1px solid #eee;
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .events-info__double-tag {
        display: inline-block;
        vertical-align: middle;
        height: 20px;
        padding: 0 5px;
        border-radius: 4px;
        margin-right: 12px;
        background: linear-gradient(45deg, #fefdd7, #fefdd7 0, #fde253 47%, #fad796);
    }

    .events-info__double-tag-icon {
        width: 16px;
        vertical-align: sub;
        margin-right: 4px;
    }

    .events-info__double-tag-text {
        color: #f3a131;
        font-size: 14px;
        line-height: 20px;
        vertical-align: middle;
    }

    .events-info__double-tag-desc {
        display: inline-block;
        line-height: 17px;
        font-size: 12px;
        color: #757575;
        font-weight: 400;
        vertical-align: middle;
    }

    .product-title,
    .product__section-title {
        font-size: 20px;
        line-height: 24px;
        font-weight: 400;
        color: #757575;
        margin-top: 30px;
        margin-bottom: 20px;
    }


    .sku-section__list {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        min-height: 58px;
    }

    .section__item {
        margin: 10px auto 0;
    }

    .sku-section__button {
        padding: 10px 20px;
        width: 160px;
        min-height: 58px;
        height: 100%;
        font-size: 16px;
        line-height: 20px;
        color: #757575;
        text-align: center;
        border: 1px solid #eee;
        background-color: #fff;
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
        transition: opacity, border .2s linear;
    }

    .sku-section__button span {
        text-align: left;
        overflow: hidden;
        text-overflow: ellipsis;
        word-break: break-word;

    }

    .sku-section__itemn {
        margin-left: 0;
        margin-right: 10px;
    }

    .sku-section__icon-item .sku-section__button {
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        overflow: hidden;
        margin-right: 10px;
    }


    .sku-section__button i {
        display: inline-block;
        flex-shrink: 0;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        margin-right: 10px;
        box-shadow: 0 2px 8px 0 rgba(0, 0, 0, .1);
    }



    .quantity-section__content {
        display: inline-flex;
        max-width: 138px;
        height: 38px;
        border: 1px solid #e0e0e0;
        box-sizing: border-box;
        overflow: hidden;
    }


    .order-list-section {
        background-color: #fff;
        padding: 20px;
        box-sizing: border-box;
        width: 100%;
        margin-top: 30px;
    }

    .order-list-section .order-list-section__list {
        padding: 4px 0 4px 10px;
    }

    .order-list-section .order-list-section__item:first-child {
        margin-top: 0;
    }

    .order-list-section .order-list-section__item {
        margin: 15px 0;
        font-size: 16px;
        color: #757575;
        min-height: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .order-list-section .order-list-section__item span {
        text-align: left;
        font-style: normal;
        text-overflow: ellipsis;
        margin-right: 12px;
        font-size: 16px;
        color: #757575;
    }

    .order-list-section .order-list-section__item-spacer {
        flex-grow: 1;
    }

    .order-list-section .order-list-section__item strong {
        font-weight: inherit;
        white-space: nowrap;
    }

    .order-list-section .order-list-section__item small {
        font-size: inherit;
        white-space: nowrap;
    }

    .order-list-section .order-list-section__item del {
        margin-left: 6px;
        white-space: nowrap;
        font-size: 16px;
        color: #757575;
    }

    .order-list-section .order-list-section__item--total {
        margin-top: 20px;
        color: #ff6700;
        font-size: 20px;
        height: 36px;
        align-items: baseline;

    }

    .order-list-section .order-list-section__item--total {
        margin-top: 20px;
        color: #ff6700;
        font-size: 20px;
        height: 36px;
        align-items: baseline;
    }

    .order-list-section .order-list-section__item:last-child {
        margin-bottom: 0;
    }

    .order-list-section .order-list-section__item span {
        text-align: left;
        font-style: normal;
        text-overflow: ellipsis;
        margin-right: 12px;
    }

    .order-list-section .order-list-section__item-spacer {
        flex-grow: 1;
    }

    .order-list-section .order-list-section__item--total strong {
        font-weight: 400;
        font-size: 30px;
    }

    .order-list-section .order-list-section__item--total small {
        font-size: 20px;
    }

    .order-list-section .order-list-section__item--total del {
        display: none;
        color: #ddd;
        opacity: 0;
        visibility: hidden;
        margin-left: 6px;
        white-space: nowrap;
    }


    /* 立即購買 */
    .add-cart-section {
        width: 100%;
        padding: 0;
        display: flex;
        flex-flow: column nowrap;
        align-items: center;
        margin-top: 40px;
    }

    .add-cart-section .add-cart-section__wrap {
        box-sizing: border-box;
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        height: 50px;
        width: 100%;
    }

    .add-cart-section .add-cart-section__submit-group {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .add-cart-section .add-cart-section__submit-group .add-cart-section__submit {
        width: 50%;
        font-size: 20px;
        text-transform: uppercase;
        border-color: #ff6700;
        background-color: #ff6700;
    }

    .mi-input-alert {
        position: relative;
        margin-top: 3px;
        margin-bottom: 3px;
        width: 100%;
        min-height: 20px;
    }


    /* 讓選到的會亮起 */
    .product-select .capacity.active {
        border-color: #ff6700;
    }

    .product-select .select.active {
        border-color: #ff6700;
    }
</style>


@endsection

@section('content')
<section class="features3 cid-rRF3umTBWU" id="features3-7">
    <div class="container">
        <div class="row">
            <div class="col-6">

            </div>
            <div class="col-6">
                <section class="title">
                    <h1>
                        <span>Redmi Note 7</span>
                    </h1>
                    <div class="product-info">
                        <div class="information-section__product-sku-info">4GB+128GB, 夢幻藍</div>
                        <div class="information-section__product-price">
                            <strong>
                                <small>NT$</small>
                                5,499
                            </strong>
                            <del>NT$6,999</del>
                        </div>
                    </div>
                </section>

                <section class="product-tips">
                    <div class="events-info__double">
                        <div class="events-info__double-tag"><img class="events-info__double-tag-icon" src="//i01.appmifile.com/webfile/globalimg/i18n_frontend/points_center/gold-points.png" alt="icon"><span class="events-info__double-tag-text">雙倍</span></div>
                        <p class="events-info__double-tag-desc">該商品可享受雙倍積分</p>
                    </div>
                </section>

                <!-- 產品規格內容 -->
                <section class="specification">
                    <h3 class="product-title">容量</h3>
                    <ul class="sku-section__list product-select">
                        <li class="sku-section__item">
                            <button class="sku-section__button capacity" data-label="4GB+128GB">
                                <span>4GB+128GB</span>
                            </button>
                        </li>
                        <li class="sku-section__item">
                            <button class="sku-section__button capacity"  data-label="8GB+256GB">
                                <span>8GB+256GB</span>
                            </button>
                        </li>
                    </ul>
                    <h3 class="product__section-title">顏色</h3>
                    <ul class="sku-section__list product-select">
                        <li class="sku-section__icon-item">
                            <button class="sku-section__button select" data-color="夢幻藍">
                                <i style="background-color: rgb(40, 94, 225);"></i>
                                <span>夢幻藍</span>
                            </button>
                        </li>
                        <li class="sku-section__icon-item">
                            <button class="sku-section__button select" data-color="亮黑色">
                                <i style="background-color: rgb(0, 0, 0);"></i>
                                <span>亮黑色</span>
                            </button>
                        </li>
                    </ul>
                </section>

                <!-- 產品數量 -->
                <section class="product__section quantity-section">
                    <h3 class="product__section-title">數量</h3>
                    <a id="minus" href="">-</a>
                    <input type="number" value="1", id="qty" min="0">
                    <a id="plus" href="">+</a>
                </section>

                <!-- 產品總結 -->

                <section class="product__section order-list-section">
                        <ul class="order-list-section__list">
                        <li class="order-list-section__item">
                            <span>Redmi Note
                                <input type="text" name="product_id" id="product_id">
                                <input type="text" name="capacity" id="capacity">
                                <input type="text" name="color" id="color"></span>
                            <div class="order-list-section__item-spacer"></div><strong><small>NT$</small>5,499</strong><del>NT$6,999</del>
                        </li>
                        <li class="order-list-section__item order-list-section__item--total"><span>總計：</span>
                            <div class="order-list-section__item-spacer"></div><strong><small>NT$</small>5,499</strong><del>NT$6,999</del>
                        </li>
                    </ul>
                </section>

                <!-- 立即購買 -->
                <section class="product__section add-cart-section">
                    <div class="add-cart-section__wrap">
                        <div class="add-cart-section__submit-group"><button class="add-cart-section__btn add-cart-section__submit add-cart-section__submit--main" aria-label="立即購買">立即購買</button></div>
                    </div>
                    <div class="mi-input-alert"></div>
                </section>
            </div>

        </div>
    </div>
</section>
@endsection


@section('js')
<script>
    $('.product-select .capacity').click(function() {
        $('.product-select .capacity').removeClass("active");
        $(this).addClass("active");

        var capacity = $(this).attr("data-label");
        $('#capacity').val(capacity)
    });

    $('.product-select .select').click(function() {
        $('.product-select .select').removeClass("active");
        $(this).addClass("active");

        var color = $(this).attr("data-color");
        $('#color').val(color)
    });


    var valueElement = $('#qty');
    function incrementValue(e){
        var now_number = $('#qty').val();
        // console.log('now_number')
        var new_bumber = Math.max(e.data.increment + parseInt(now_number), 0);
        $('#qty').val(new_number);

        return false;
    }
    // function incrementValue(e){
    //     valueElement.text(Math.max(parseInt(valueElement.text()) + e.data.increment, 0));
    //     return false;
    // }

    $('#plus').bind('click', {increment: 1}, incrementValue);
    $('#minus').bind('click', {increment: -1}, incrementValue);

</script>
@endsection
