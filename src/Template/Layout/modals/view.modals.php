<!-- TEST-DRIVE-MODAL -->
<div class="modal fade bs-example-modal-lg" id="test_drive_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
            <div class="modal-content" style="padding-bottom: 0 !important;">
                <div class="modal-header">
                    
                </div>
           
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" style="font-size: 50px; opacity: 0.8;">&times;</button>
                    <h4>Заявка <br /><span>на тест-драйв</span></h4>
                    <form action="#" method="POST" id="td_query_form_3">
                        <p class="response">Вместо 1000 слов - один тест-драйв!</p>
                        <input type="text" name="name" placeholder="Ваше Имя" />
                        <input type="text" name="phone" placeholder="Ваш телефон" />
                        
                        <button type="button" onclick="ajax.submit_td3();" class="submit">Записаться</button>
                        <p class="cancel_td" onclick="locals.cancel_td_modal();">Спасибо, но я передумал</p>
                    </form>
                </div>
                
            </div>
    </div>
</div>
<!-- /TEST-DRIVE-MODAL -->
