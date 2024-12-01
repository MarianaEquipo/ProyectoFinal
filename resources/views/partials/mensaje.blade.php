<div>
    @if (session('mensaje'))
        <div class="alert alert-danger" id="mensaje">
            {{session('mensaje')}}
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded',function(){
            const mensaje=document.getElementById('mensaje');
            if(mensaje){
                setTimeout(() => {
                    mensaje.remove()
                }, 3000);
            }
        });
    </script>
</div>