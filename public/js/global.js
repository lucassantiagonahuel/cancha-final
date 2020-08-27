moment().locale("es");


$(document).ready(function(){
    

//     $('#menu').append(`
// `);

    


// menu slide
var slideout = new Slideout({
    'panel': document.getElementById('main-wrapper'),
    'menu': document.getElementById('menu'),
    'padding': 256,
    'tolerance': 70
  });

  // Toggle button
//   document.querySelector('.nav-toggler').addEventListener('click', function() {
//     slideout.toggle();
//   });
$('#btn_superior_hamburguesa').on('click', function(){
    slideout.toggle();
})

function close(eve) {
    eve.preventDefault();
    slideout.close();
  }
  
  slideout
    .on('beforeopen', function() {
      this.panel.classList.add('panel-open');
    })
    .on('open', function() {
      this.panel.addEventListener('click', close);
    })
    .on('beforeclose', function() {
      this.panel.classList.remove('panel-open');
      this.panel.removeEventListener('click', close);
    });



    $('body').addClass('active');
    
})

// $('#menu_lateral a').on('click', function(e){
//     e.preventDefault();
//     slideout.close();
// })

// document.on('click', '#menu_lateral a', function)
$(document).on("click","#menu_lateral a",function(e) {
    // e.preventDefault();
    // close();
    $('#btn_superior_hamburguesa').click();
    // alert("click");
});