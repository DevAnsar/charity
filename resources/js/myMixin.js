import axios from 'axios';
export default {
    methods: {
        replaceNumber:function (n){
            if(n!=undefined){
                n=n.toString();
                const find=["0","1","2","3","4","5","6","7","8","9"];
                const replace=["۰","۱","۲","۳","۴","۵","۶","۷","۸","۹"];
                for (let i=0;i<find.length;i++)
                {
                    n=n.replace(new RegExp(find[i],'g'),replace[i]);
                }
                return n;
            }
        },
        number_format:function (num){
            num=num.toString();
            let format='';
            let counter=0;
            for (let i=num.length-1;i>=0;i--)
            {
                format+=num[i];
                counter++;
                if(counter==3){
                    format+=",";
                    counter=0;
                }
            }
            return format.split('').reverse().join('');
        },

        get_request_url:function (url,page) {
            const url_params=url.split('?');
            if(url_params[1]==undefined){
                url=url+"?page="+page;
            }
            else {
                url=url+"&page="+page;
            }
            return url
        },

        setRangSlider:function (price) {
            // console.log('price',price);
            const app=this;
            var slider = document.getElementById('slider-non-linear-step');
            if(this.noUiSlider==null){
                if(parseInt(price)>0)
                {
                    this.noUiSlider=noUiSlider.create(slider, {
                        start: [0, price],
                        connect: true,
                        direction:'rtl',
                        range: {
                            'min': [0],
                            'max': [parseInt(price)]
                        },
                        format:{
                            from:function (value) {
                                return parseInt(value);
                            },
                            to:function (value) {
                                return parseInt(value);
                            },
                        }
                    });
                }
            }

            if(slider.noUiSlider!=undefined){

                var nonLinearStepSliderValueElement = document.getElementById('slider-non-linear-step-value');
                slider.noUiSlider.on('update',function (values,handle) {
                    app.min_price=values[0];
                    app.max_price=values[1];
                    let min_p=app.replaceNumber(app.number_format(values[0]));
                    let max_p=app.replaceNumber(app.number_format(values[1]));
                    // $("#min_price").text(min_p);
                    // $("#max_price").text(max_p);

                        nonLinearStepSliderValueElement.innerHTML =  min_p+' - '+max_p;

                });

                let search=new window.URLSearchParams(window.location.search);
                const min=search.get('price[min]')!=null ? parseInt(search.get('price[min]')) : 0;
                if(search.get('price[max]')!=null){
                    slider.noUiSlider.updateOptions({
                        start:[min,parseInt(search.get('price[max]'))]
                    })
                }

                if(search.get('price[min]')!=null && search.get('price[max]')==null){
                    slider.noUiSlider.updateOptions({
                        start:[parseInt(search.get('price[min]')),slider.noUiSlider.get()[1]]
                    })
                }
            }
        },
        check_search_params:function (page_url) {
            let url=page_url==undefined ? window.location.href : page_url;
            const params=url.split('?');
            if(params[1]!=undefined){
                if(params[1].indexOf('&')>-1){
                    let vars=params[1].split('&');
                    for (let i in vars){
                        let k=vars[i].split('=')[0];
                        let v=vars[i].split('=')[1];
                        k=k.split('[');
                        this.add_active_filter(k,v);
                    }
                }
                else {
                    let k=params[1].split('=')[0];
                    let v=params[1].split('=')[1];
                    k=k.split('[');
                    this.add_active_filter(k,v);
                }
            }
        },
        add_active_filter:function (k,v) {
            if(k.length>1){
                let data="";
                let filter_key=k[0];
                if(k.length==3){
                    data=k[0]+"["+k[1]+"_param_"+v;
                    data="'"+data+"'";
                    filter_key=k[0]+"["+k[1];
                }
                else {
                    data=k[0]+"_param_"+v;
                }
                $('li[data='+data+'] .check_box').addClass('active');
                $('li[data='+data+']').parent().parent().slideDown();
                if($('li[data='+data+']').parent().parent().parent().parent().find('.title_box').find('span').hasClass('fa-plus-circle')){
                    $('li[data='+data+']').parent().parent().parent().parent().find('.title_box').find('span').removeClass('fa-plus-circle').addClass('fa-minus-circle')
                }
                if($('li[data='+data+']').length==1){
                    this.add_filter_tag(data,filter_key,v);
                }
            }
            else{
                if(k=="has_product"){
                    this.set_enable_product_status_toggle();
                }

            }
        },
        add_filter_tag:function (data,k,v) {
            $("#filter_div").show();
            data=data.toString().replace(',','_').replace(',','_');
            data=data.toString().replace("'",'').replace("'",'');
            data="'"+data+"'";
            const el="li[data="+data+"]";
            const title=$(el).parent().parent().parent().parent().find('.title_box').text();
            const html='<div class="selected_filter_item " data-key="'+k+'" data-value="'+v+'">' +
                '<span>' +
                title+":"+$(el).find('.title').text() +
                '</span>' +
                '<span class="mdi mdi-close-circle"></span>' +
                '</div>';

            $("#selected_filter_box").append(html);
        },
        set_enable_product_status_toggle:function () {
            if(!$("#selected_filter_box").find('div').hasClass('product_status_filter'))
            {
                $("#filter_div").show();
                const html='<div class="selected_filter_item product_status_filter">' +
                    '<span>فقط کالاهای موجود</span> <span class="mdi mdi-close-circle"></span>' +
                    '</div>';
                $("#selected_filter_box").append(html);
            }
        },
        set_product_sort:function () {
            let params=new window.URLSearchParams(window.location.search);
            let url=window.location.href;
            if(params.get("sortby")!=null){
                const sortby=parseInt(params.get("sortby"));
                if(sortby>=21 && sortby<=25){
                    this.sort=sortby;
                }
            }
        },
        set_search_string:function () {
            let params=new window.URLSearchParams(window.location.search);
            let url=window.location.href;
            if(params.get('string')!=null){
                this.search_string=params.get('string');
                if(!$("#selected_filter_box").find('div').hasClass('search_product'))
                {
                    $("#filter_div").show();
                    const html='<div class="selected_filter_item search_product">' +
                        '<span>'+params.get('string')+'</span> <span class="mdi mdi-close-circle"></span>' +
                        '</div>';
                    $("#selected_filter_box").append(html);
                }
            }
        },

        remove_url_params:function (key,value,page_url) {
            let params=new window.URLSearchParams(window.location.search);
            if(page_url!=undefined)
            {
                let search_url_params=this.search_url.split('?');
                if(search_url_params[1]!=undefined)
                {
                    search_url_params='?'+search_url_params[1];
                    params=new window.URLSearchParams(search_url_params);
                }
            }
            let url=page_url==undefined ? window.location.href : page_url;
            if(params.get(key)!=null){
                value=encodeURIComponent(value);
                url=url.replace('&'+key+"="+value,'');
                url=url.replace('?'+key+"="+value,'');
                this.remove_filter_tag(key,value);

                const url_params=url.split('?');
                if(url_params[1]==undefined){
                    url=url.replace('&','?');
                }

                if(page_url==undefined)
                {
                    this.setPageUrl(url);
                    this.getProduct(1);
                }
                else {
                    this.search_url=url;
                }
            }
        },
        set_filter_event:function (el,page_url) {
            let data=$(el).attr('data');

            console.log('data attr',data);
            data=data.split('_');
            if($('.check_box',el).hasClass('active')){
                $('.check_box',el).removeClass('active');
                this.remove_url_query_string(data[0],data[2],page_url);
                this.remove_filter_tag(data[0],data[2],page_url);
            }
            else{
                $('.check_box',el).addClass('active');
                this.add_url_query_string(data[0],data[2],page_url);
                this.add_filter_tag(data,data[0],data[2],page_url);
            }
        },

        remove_all_filter:function (page_url) {
            let url=page_url==undefined ? window.location.href : page_url;
            url=url.split('?')[0];
            $('.selected_filter_item').remove();
            $("#filter_div").hide();
            $('.filter_box .list-inline li').find('.check_box').removeClass('active');

            $("#switcher-hasProduct").attr('checked', false);


            if(this.noUiSlider)
            {
                this.noUiSlider.reset();
            }
            if(page_url==undefined){
                this.setPageUrl(url);
                this.getProduct(1);
            }
            else {
                this.search_url=url;
            }
        },

        showModalBox:function(){
            // console.log(this.$refs);
            this.$refs.AddressesFormRef.setTitle('افزودن آدرس');
            $("#AddressModal").modal('show');
        },
        updateRow:function (address) {

            this.$refs.AddressesFormRef.setUpdateData(address,'ویرایش آدرس');
            if(address['lat']!="0.0")
            {
                updateMap(address['lat'],address['lng']);
            }
        },

        remove_address:function (address) {
            console.log(address);
            this.remove_address_id=address.id;
            // this.show_dialog_box=true;
            $("#remove-location").modal('show');
        },
        delete_address:function () {

            $("#loading_box").show();
            // this.show_dialog_box=false;
            const url="/remove-address/"+this.remove_address_id;
            axios.delete(url).then(response=>{
                window.location.reload();
                // $("#loading_box").hide();
                // if(response.data!="error")
                // {
                //     this.AddressLists=response.data;
                // }
            }).catch(error=>{
                $("#loading_box").hide();
            });
        },
        check_mobile_number() {
            if(isNaN(this.mobile))
            {
                return true;
            }
            else {
                if(this.mobile.toString().trim().length==11)
                {
                    if(this.mobile.toString().charAt(0)=='0' && this.mobile.toString().charAt(1)=='9' )
                    {
                        return  false;
                    }
                    else
                    {
                        return true;
                    }
                }
                else if(this.mobile.toString().trim().length==10)
                {
                    if(this.mobile.toString().charAt(0)=='9')
                    {
                        return  false;
                    }
                    else
                    {
                        return true;
                    }
                }
                else{
                    return  true;
                }
            }
        },
    }
}