let lat='38.0412';
let lng='46.3993';
let marker=null;
let map=null;
L.cedarmaps.accessToken ='196066ad375f95ed4c14b7eaaa2f7457af233d76';
const tileJSONUrl = 'https://api.cedarmaps.com/v1/tiles/cedarmaps.streets.json?access_token=' + L.cedarmaps.accessToken;
map = L.cedarmaps.map('map', tileJSONUrl, {
    scrollWheelZoom: true
}).addControl(L.cedarmaps.geocoderControl('cedarmaps.streets',{
    keepOpen:false,
    autocomplete:true,
})).setView([lat, lng], 16);
marker=L.marker([lat,lng]).addTo(map);
$('#myModal').on('show.bs.modal', function()
{

    setTimeout(function(){ map.invalidateSize()}, 500);

    get_my_location();
    map.on('move',function (e) {
        lat = e.target.getCenter().lat;
        lng = e.target.getCenter().lng;
        marker.setLatLng({lat:lat,lng:lng});
    });
});
get_my_location=function ()
{
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(set_my_location);
    }
    else
    {
        alert('مرورگر شما از قابلیت مکان یابی پشتبانی نمی کند');
    }
};
set_my_location=function (position)
{
    lat=position.coords.latitude;
    lng=position.coords.longitude;
    if(map!=null){
        map.panTo(new L.LatLng(lat,lng));
        marker.setLatLng({lat:lat,lng:lng});
    }
};
$("#select_location_btn").click(function (){
    document.getElementById('lat').value=lat;
    document.getElementById('lng').value=lng;
});
updateMap=function (lat,lng) {
    document.getElementById('lat').value=lat;
    document.getElementById('lng').value=lng;
    if(map!=null)
    {
        map.panTo(new L.LatLng(lat,lng));
        marker.setLatLng({lat:lat,lng:lng});

    }
};
$(document).on('click','#change_map',function () {
    setTimeout(function(){ map.invalidateSize()}, 500);
    get_my_location();
    map.on('move',function (e) {
        lat = e.target.getCenter().lat;
        lng = e.target.getCenter().lng;
        marker.setLatLng({lat:lat,lng:lng});
    });
});
