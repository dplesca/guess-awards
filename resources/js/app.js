/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');

require('bootstrap');


/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


$(function(){
    $('.pick li').click(async function(ev){
        let r = await sendPick($(this).data('category'), $(this).data('nominee'));
        $(this).parent().find('li').removeClass('bg-success')
        $(this).addClass('bg-success');
        console.log(r);
    });
});

function sendPick(category, nominee){
    return axios.post("/pick", {
        'category_id': category,
        'nominee_id': nominee,   
    });
}