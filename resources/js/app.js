import './bootstrap';


const channel = window.Echo.channel(`public.stations.1`);
channel.subscribed(() => {
    console.log('Subscribed!!!');
})
channel.listen('.stations-status', (e) => {
    console.log(e);
});
// window.addEventListener('load', function (){
//
// })
