
if(document.querySelector( '#description' ) != null){
    ClassicEditor
    .create( document.querySelector( '#description' ),{
        removePlugins: [ 'Image', 'ImageCaption', 'EasyImage', 'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed' ]
    } )
    .catch( error => {
        console.error( error );
    } );  
}

// NAVBAR 
document.addEventListener('scroll', () => {

    let navbar = document.getElementById('navbar')
    let toggler = document.getElementById('toggler')

    if (window.pageYOffset > 60) {  
        navbar.classList.add('scrolled','bg-white', 'shadow')
        toggler.classList.remove('text-light')
        toggler.classList.add('text-dark')
    }  else  {
        navbar.classList.remove('scrolled','bg-white','shadow')
        toggler.classList.remove('text-dark')
        toggler.classList.add('text-light')
    }
})

    // ALTERNATIVA FATTA CON JAVASCRIPT
    // let navbar = document.querySelector('#navbar')
    // let toggler = document.querySelector('#navbar')

    // if(window.innerWidth > 576){
    //     document.addEventListener('scroll', ()=> {
    //         if(window.pageYOffset > 20) {
    //             navbar.classList.remove('bg-transparent')
    //             navbar.classList.add('bg-white', 'shadow')
    //         } else {
    //             navbar.classList.remove('bg-white','shadow')
    //             navbar.classList.add('bg-transparent')
    //         }
    //     })
    // }
    

