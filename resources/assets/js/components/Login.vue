<template>
<div class="login">
   <div class="container">
       <div class="col-md-6 offset-md-3">
           
            <div class="inner-form">
                
                   <form role="form" method="POST" action="/login">
            		   <div class="row">
            		       
        			    	<div class="col-md-12">
        			    	    <label>Email</label>
        			    	    <div class="form-group">
        			    			<input type="email" name="email" id="email" class="form-control" placeholder="">
        			    		</div>
        			    	</div>
        			    	
        			    	<div class="col-md-12">
        			    	    <label>Password</label>
        			    	    <div class="form-group">
        							<input type="password" name="password" id="password" class="form-control" placeholder="">
        			    		</div>
        			    	</div>
        			    	
        					<div class="col-md-12">
                                <input type="hidden" name="_token" />
        					    <button type="submit" class="btn btn-default">
        							<span>LOGIN</span>
        						</button>
        					</div>
        					
            			 </div>
            	     </form>
    	    
                </div> <!-- inner-form -->
			
		</div>   
	</div>   
</div>  
</template>

<script>
    export default {
        mounted() {
            console.log('login Component mounted.')
            $("input[name=_token]").val(document.head.querySelector('meta[name="csrf-token"]').content);
        }
    }
</script>
