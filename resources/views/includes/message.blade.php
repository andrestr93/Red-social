<!-- include que inluye una condicion que si llega la sesion del mensaje que lo muestre  -->
@if(session('message'))

<div class="alert alert-success">
    
    {{session ('message')}}
</div>


@endif