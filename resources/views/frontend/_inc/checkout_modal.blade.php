     <!-- Modal Cash on Transfer-->
     <div class="modal fade" id="cod" tabindex="-1" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h6 class="modal-title">{{ __('Transaction Cash On Delivery') }}</h6>
                     <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 </div>
                 <form action="{{ route('frontend.checkout.submit') }}" method="POST">
                     @csrf
                     <input type="hidden" name="payment_method" value="Cash On Delivery" id="">
                     <div class="card-body">
                         <p>{{ PriceHelper::gatewayText('cod') }}</p>
                     </div>
                     <div class="modal-footer">
                         <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                         <button class="btn btn-primary btn-sm" type="submit">{{ __('Cash On Delivery') }}</button>
                 </form>
             </div>
         </div>
     </div>
     </div>
     </div>
