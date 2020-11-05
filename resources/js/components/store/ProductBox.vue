<template>
    <div class="dt-sl dt-sn px-0 search-amazing-tab">
        <div class="ah-tab-wrapper dt-sl">
            <div class="ah-tab dt-sl">
                <a :class="sort==21 ? 'active ah-tab-item' : 'ah-tab-item'" v-on:click="set_sort(21)">پربازدید ترین</a>
                <a :class="sort==22 ? 'active ah-tab-item' : 'ah-tab-item'" v-on:click="set_sort(22)">محبوب ترین</a>
                <a :class="sort==23 ? 'active ah-tab-item' : 'ah-tab-item'" v-on:click="set_sort(23)">جدید ترین</a>
                <a :class="sort==24 ? 'active ah-tab-item' : 'ah-tab-item'" v-on:click="set_sort(24)">ارزان ترین</a>
                <a :class="sort==25 ? 'active ah-tab-item' : 'ah-tab-item'" v-on:click="set_sort(25)">گران ترین</a>

                <div class="ah-tab-item float-left" id="product_count"></div>
            </div>

        </div>
        <div class="ah-tab-content-wrapper dt-sl px-res-0">
            <div class="row mb-3 mx-0 px-res-0">

                <div v-for="product in this.productList.data" :key="product.id"
                     class="col-lg-3 col-md-4 col-sm-6 col-12 px-10 mb-1 px-res-0 ">
                    <div class="product-card mb-2 mx-res-0">
                        <!--<div class="promotion-badge">-->
                        <!--فروش ویژه-->
                        <!--</div>-->
                        <div class="product-head">
                            <div class="rating-stars">
                                <i v-for="item in [1,2,3,4,5]" :key="item"
                                   :class="['mdi' , 'mdi-star',item<=product.rate?'active':'' ]"></i>
                                <!--<i class="mdi mdi-star active"></i>-->
                                <!--<i class="mdi mdi-star active"></i>-->
                                <!--<i class="mdi mdi-star active"></i>-->
                                <!--<i class="mdi mdi-star active"></i>-->
                            </div>
                            <div class="discount">
                                <span v-if="product.discount>0">
                                    {{product.discount}}
                                    %
                                </span>
                            </div>
                        </div>
                        <a class="product-thumb" :href="getProductUrl(product.slug)">
                            <img :src="getImage(product.main_image[0].url)" alt="Product Thumbnail">
                        </a>
                        <div class="product-card-body">
                            <h5 class="product-title">
                                <a :href="getProductUrl(product.slug)">{{product.title}}</a>
                            </h5>
                            <a v-if="product.category!=null" class="product-meta" :href="getProductCat(product.category.slug)" >
                                {{product.category.title}}
                            </a>
                            <span class="product-price">
                                {{numberFormat(product.price*(1-product.discount/100))}}
                                تومان
                            </span>
                        </div>
                    </div>
                </div>

                <div v-if="this.productList.data.length==0 && get_result" class="col-12">
                    <div class="row justify-content-center">
                        <div class="col-10 checkout-address-location">
                            محصولی برای نمایش یافت نشد
                        </div>
                    </div>
                </div>
            </div>
            <!--<div class="row">-->
                <!--<div class="col-12">-->
                    <div class="paginate_div">
                    <pagination
                            :data="this.productList"
                            size="small"
                            align="center"
                            @pagination-change-page="getProduct"
                    ></pagination>
                    </div>
                    <!--<div class="pagination">-->
                    <!--<a href="#" class="prev"><i-->
                    <!--class="mdi mdi-chevron-double-right"></i></a>-->
                    <!--<a href="#">1</a>-->
                    <!--<a href="#" class="active-page">2</a>-->
                    <!--<a href="#">3</a>-->
                    <!--<a href="#">4</a>-->
                    <!--<a href="#">...</a>-->
                    <!--<a href="#">7</a>-->
                    <!--<a href="#" class="next"><i class="mdi mdi-chevron-double-left"></i></a>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
        </div>
    </div>
</template>

<script>
    import myMixin from "../../myMixin";

    export default {
        name: "ProductBox",

        data() {
            return {

                sort: 21,
                min_price: 0,
                max_price: 0,
                request_url: '',
                get_result: false,
                productList: [],
            }

        },
        mixins: [myMixin],
        mounted() {
            const app = this;
            this.check_search_params();
            this.set_product_sort();
            this.set_search_string();
            $(document).on('click', '#price_filter_btn', function () {
                app.setFilterPrice();
            });
            $(document).on('click','.product_cat_ul li',function () {
                app.set_filter_event(this);
            });
            $(document).on('keyup', '#search_input', function (event) {
                app.search_product(event, this);
            });
            $(document).on('change', '#switcher-hasProduct', function (e) {
                app.set_product_status(e, this.checked);
            });

            $(document).on('click', '.selected_filter_item', function () {
                app.remove_filter_item(this);
            });
            $(document).on('click','#remove_all_filter',function(){
                app.remove_all_filter();
            });
            this.getProduct();
        },
        methods: {
            getProductCat(slug) {
                return '/search/' + slug;
            },
            getImage(url) {
                return '/storage/' + url;
            },
            getProductUrl(url) {
                return '/product/' + url;
            },
            numberFormat(num) {
                return this.number_format(num)
            },
            getProduct: function (page = 1) {
                console.log(page);
                $("#loading_box").show();
                this.request_url = window.location.href.replace(this.$siteUrl, this.$siteUrl + '/getProduct');
                // console.log('ansaramman',this.request_url);
                window.axios.get(this.get_request_url(this.request_url, page))
                    .then(response => {
                        this.productList = response.data['product'];
                        this.setRangSlider(response.data.max_price);
                        $("#loading_box").hide();
                        this.get_result = true;
                        if (response.data['count'] != undefined) {
                            $("#product_count").text(this.replaceNumber(response.data['count']) + " کالا");
                        }
                    });
            },
            add_url_param: function (key, value, repet) {
                let params = new window.URLSearchParams(window.location.search);
                let url = window.location.href;
                if (params.get(key) != null) {
                    let old_param = key + "=" + encodeURIComponent(params.get(key));
                    let new_param = key + "=" + value;
                    url = url.replace(old_param, new_param);
                }
                else {
                    const url_params = url.split('?');
                    if (url_params[1] == undefined) {
                        url = url + "?" + key + "=" + value;
                    }
                    else {
                        url = url + "&" + key + "=" + value;
                    }
                }

                this.setPageUrl(url);
            },
            setPageUrl: function (url) {
                window.history.pushState('data', 'title', url);
            },
            set_sort: function (value) {
                this.sort = value;
                this.add_url_param('sortby', value);
                this.getProduct(1);
            },

            setFilterPrice: function () {
                this.add_url_param('price[min]', this.min_price);
                this.add_url_param('price[max]', this.max_price);
                this.getProduct(1);
            },


            search_product: function (event, el) {
                if (event.keyCode == 13) {
                    const search_text = $(el).val();
                    if (search_text.trim().length == 0) {
                        if (this.search_string != "") {
                            this.remove_url_params('string', this.search_string);
                            this.search_string = '';
                            $('.search_product').remove();
                            if ($("#selected_filter_box div").length == 0) {
                                $("#filter_div").hide();
                            }
                            this.getProduct(1);
                        }
                    }
                    else {
                        if (search_text.trim().length > 1) {
                            // console.log('search_text',search_text.trim());
                            this.search_string = search_text.toString().trim();
                            this.add_url_param('string', this.search_string);
                            if (!$("#selected_filter_box").find('div').hasClass('search_product')) {
                                $("#filter_div").show();
                                const html = '<div class="selected_filter_item search_product">' +
                                    '<span>' + this.search_string + '</span> <span class="mdi mdi-close-circle"></span>' +
                                    '</div>';
                                $("#selected_filter_box").append(html);
                            } else {
                                // console.log('filter_div');
                                this.set_search_string();
                            }
                            this.getProduct(1);
                        }
                    }
                }
            },
            remove_filter_tag: function (k, v) {
                $('.selected_filter_item[data-key="' + k + '"][data-value="' + v + '"]').remove();
                if ($("#selected_filter_box div").length == 0) {
                    $("#filter_div").hide();
                }
            },

            set_product_status: function (e, action) {
                // alert(action);
                if (!action) {
                    this.remove_url_params('has_product', 1);
                    this.getProduct(1);

                    $('.product_status_filter').remove();
                    if ($("#selected_filter_box div").length == 0) {
                        $("#filter_div").hide();
                    }
                }
                else {
                    this.add_url_param('has_product', 1);
                    this.getProduct(1);

                    if (!$("#selected_filter_box").find('div').hasClass('product_status_filter')) {
                        $("#filter_div").show();
                        const html = '<div class="selected_filter_item product_status_filter">' +
                            '<span>فقط کالاهای موجود</span> <span class="mdi mdi-close-circle"></span>' +
                            '</div>';
                        $("#selected_filter_box").append(html);
                    }
                }
            },

            remove_filter_item: function (el) {
                const key = $(el).attr('data-key');
                const value = $(el).attr('data-value');
                if (key && value) {
                    this.remove_url_query_string(key,value);
                    $(el).remove();
                    const data=key+"_param_"+value;
                    $('li[data="'+data+'"] .check_box').removeClass('active');
                    if($("#selected_filter_box div").length==0){
                        $("#filter_div").hide();
                    }
                }
                else if ($(el).hasClass('product_status_filter')) {
                    this.remove_product_status(el);
                }

                else if ($(el).hasClass('search_product')) {
                    const text = $(el).text();
                    $(el).remove();
                    this.remove_url_params('string', text.toString().trim());
                    document.getElementById('search_input').value = '';
                    this.getProduct(1);
                }
            },
            remove_product_status: function (el) {
                $(el).remove();
                this.remove_url_params('has_product', '1');
                $("#switcher-hasProduct").click();
            },



            remove_url_query_string:function (key,value,page_url) {
                let url=page_url==undefined ? window.location.href : page_url;
                let check=url.split(key);
                const params=url.split('?');
                let h=0;
                if(params[1]!=undefined){
                    if(params[1].indexOf('&')>-1){
                        let vars=params[1].split('&');
                        for (let i in vars){
                            let k=vars[i].split('=')[0];
                            let v=vars[i].split('=')[1];
                            let n=k.indexOf(key);
                            if(n>-1 && v!=value){
                                k=k.replace(key,'');
                                k=k.replace('[','');
                                k=k.replace(']','');
                                const new_string=key+"["+h+"]="+v;
                                const old_string=key+"["+k+"]="+v;
                                url=url.replace(old_string,new_string);
                                h++;
                            }
                            else if(n>-1){
                                url=url.replace('&'+k+"="+v,'');
                                url=url.replace('?'+k+"="+v,'');
                            }
                        }
                    }
                    else {
                        url=url.replace('?'+key+"[0]"+"="+value,'');
                    }
                }

                const url_params=url.split('?');
                if(url_params[1]==undefined){
                    url=url.replace('&','?');
                }
                this.changed_url(url);
            },
            add_url_query_string:function (key,value) {
                let url=window.location.href;
                let check=url.split(key);
                const n=check.length-1;
                const url_params=url.split('?');
                if(url_params[1]==undefined){
                    url=url+"?"+key+"["+n+"]="+value;
                }
                else {
                    url=url+"&"+key+"["+n+"]="+value;
                }
                this.setPageUrl(url);
                this.getProduct(1);
            },
            changed_url:function (url) {
                this.setPageUrl(url);
                this.getProduct(1);
            },
        },
    }
</script>

<style scoped>

</style>