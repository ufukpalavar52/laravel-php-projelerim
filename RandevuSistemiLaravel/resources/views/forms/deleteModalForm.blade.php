
       
<div class="modal fade" id="myDoctor<?= $id ?>"  tabindex="5" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <center><h3>Silinsin mi ?</h3></center> <hr/>
                <form  action="{{ $url }}" method="post">
                    <input type='text' class='hidden' value='{{ $id }}' name='id'/> 
                    <table class="table">
                        <tr>
                            <td>
                                <center>
                                  <button type='submit' class="btn btn-danger" >Evet</button>
                                  
                                </center>
                            </td>
                            <td>
                                <center>
                                  
                                   <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Hayır</button>
                                </center>
                            </td>
                                             
                            
                        </tr>
                    </table>
                </form>
                
            </div>
        </div>
    
</div>
        
    