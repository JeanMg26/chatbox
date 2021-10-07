@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">

@endpush

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">Usuarios</div>
            <div class="card-body">
               <ul id="users" class="list-unstyled"></ul>

            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@push('scripts')
<script>
   axios.get('api/users')
   .then( (resp) => {

      const usersElement = document.getElementById('users');
      let users = resp.data;

      users.forEach( (user, index) => {
         
         let element = document.createElement('li');
         let link =  document.createElement('a');
         let icon = document.createElement('i')

         link.className  = 'text-decoration-none';
         link.setAttribute('href', 'javascript::void(0)');
         icon.className = 'fas fa-circle me-2 text-danger';
         icon.setAttribute('id', 'status_'+user.id);
         link.innerText = user.name;
         link.prepend(icon);
         element.append(link);
         usersElement.appendChild(element);
      });
      
   });

   // Usuarios logueados

   Echo.private('notifications')
      .listen('UserSessionChanged', (e) => {
         
         let userStatus = document.getElementById('status_'+e.user.id);
         
         userStatus.classList.remove('text-danger');
         userStatus.classList.remove('text-sucess');
         userStatus.classList.add('text-'+e.type);
      });

      // User Created
      Echo.channel('users')
         .listen('UserCreated', (e) => {
            console.log(e.user.name);

            const usersElements = document.getElementById('users');

            let element = document.createElement('li')
            element.innerText = e.user.name;
            usersElements.appendChild(element);
            
            
         });




</script>
@endpush