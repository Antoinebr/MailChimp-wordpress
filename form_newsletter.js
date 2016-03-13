// Formulaire Newsletter
$('#newsletter-form-btn').on('click',function(e){

  e.preventDefault();

  var nom = $( ".newsletter-form input[name*='nom']" ).val();
  var prenom = $( ".newsletter-form input[name='prenom']" ).val();
  var email = $( ".newsletter-form input[name*='email']" ).val();

  //return false;
  var $this = $(this);

  $.ajax({
    type: "POST",
    url: ajaxurl,
    async: true,
    timeout:5000,
    dataType: 'json', // JSON
    data:{
      action: 'form_newsletter',
      nom: nom,
      prenom: prenom,
      email: email
    },
    success: function(data){
      //this.afterAjaxCall();
      console.log(data);
      $('.erreur').remove();

      if(!data.erreur){

        $this.after("<p class='send-ok'><i class='fa fa-check'></i> Inscription résussie !</p>");

      }else{

        if(data.erreurEmail) $( ".newsletter-form input[name*='email']" ).after(data.erreurEmail);

        if(data.erreurNom) $( ".newsletter-form input[name='nom']" ).after(data.erreurNom);

        if(data.erreurPrenom) $( ".newsletter-form input[name='prenom']" ).after(data.erreurPrenom);

        if(data.erreurGlobal) $( ".newsletter-form" ).after(data.erreurGlobal);

      }
    },
    error : function(request, errorType, errorMessage){
      console.log(request);
      console.log(errorType);
      console.log(errorMessage);
    },
    beforeSend: function(){
      //alert('Avant la requête AJAX');
      $('#newsletter-form-btn').after("<i id='ajax-loader' class='fa fa-refresh fa-spin fa-2x ajax-loader'></i>");
    },
    complete:function(){
      $('#ajax-loader').remove();
    }
  });
});
// fin formulaire de contact


// Formulaire Newsletter
$('#newsletter-form-btn').on('click',function(e){
  e.preventDefault();

  //var nom = $( ".newsletter-form input[name*='nom']" ).val();
  //var prenom = $( ".newsletter-form input[name='prenom']" ).val();
  var email = $( ".newsletter-form input[name='email']" ).val();

  //return false;
  var $this = $(this);

  $.ajax({
    type: "POST",
    url: ajaxurl,
    async: true,
    timeout:5000,
    dataType: 'json', // JSON
    data:{
      action: 'form_newsletter',
      // nom: nom,
      // prenom: prenom,
      email: email
    },
    success: function(data){
      //this.afterAjaxCall();
      console.log(data);
      $('.erreur').remove();

      if(!data.erreur){

        $this.after(data.successMessage);

      }else{


        if(data.erreurNom) $( ".newsletter-form input[name='nom']" ).after(data.erreurNom);

        if(data.erreurPrenom) $( ".newsletter-form input[name='prenom']" ).after(data.erreurPrenom);

        if(data.erreurEmail) $( ".newsletter-form input[name='email']" ).after(data.erreurEmail);

        if(data.erreurGlobal) $(".newsletter-form").after(data.erreurGlobal);


      }
    },
    error : function(request, errorType, errorMessage){
      console.log(request);
      console.log(errorType);
      console.log(errorMessage);
    },
    beforeSend: function(){
      //alert('Avant la requête AJAX');
      $('#newsletter-form-btn').after("<i id='ajax-loader' class='fa fa-refresh fa-spin fa-2x ajax-loader'></i>");
    },
    complete:function(){
      $('#ajax-loader').remove();
    }
  });
});
// fin formulaire de contact
