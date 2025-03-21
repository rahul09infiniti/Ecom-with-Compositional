<template>
    <div v-show="myCartVisible" :class="{'background-fade': myCartVisible}"  class="background-overlay modal fade show" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1"  aria-hidden="true" style="display: block;">
              <div  class="modal-dialog modal-xl">
                <div  class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title fs-5" id="exampleModal1" style="font-weight: bold; color: #333;">My Cart</h5>
                    <button type="button" class="btn-close" @click="myCartVisible = false" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body" style="padding: 18px;">
                    <div class="row">
                      <div class="col-md-6 col-sm-12" style="max-height: 400px; overflow-y: auto;" >

                        <div v-for="item in cart" :key="item.id" class="cart-item d-flex justify-content-between align-items-center mb-3 p-3" style="border-bottom: 1px solid #dee2e6;">
                          <div class="cart-item-image" style="width: 70px; height: 70px; overflow: hidden; margin-right: 15px; border-radius: 8px;">
                            <img :src="item.images[0]" alt="Product Image" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                          </div>
                          <div class="cart-item-details flex-grow-1 d-flex flex-column ">
                            <h4 class="mb-1" style="font-size: 1.1rem; color: #333; font-weight: bold;">{{ item.title }}</h4>
                            
      
                            <div class=" d-flex  mb-3">
      
                              <div><p v-if="item.discountPrice" style="margin-right: 10px; color: #28a745; font-size: 1rem; font-weight: 500;"> Price : ${{((item.discountPrice) *  (item.quantity)).toFixed(2)}}</p></div>
                              <div>
                                <span class="text-danger" style="font-size: 1rem;"> 
                                  <s> ${{ ((item.price)* (item.quantity)).toFixed(2) }}</s>
                                </span>
                              </div>
                            </div>
                          </div>
      
                          <div class="d-flex justify-content-center align-items-center">
                            <div class="cart-item-quantity" style="text-align: center; margin-right: 14px;">
                              <label class="mb-2 d-block" style="font-size: 0.9rem;">Quantity</label>
                              <div class="input-group mb-3" style="width: 150px;">
                                <button class="btn btn-outline-secondary px-3" type="button" id="button-addon1" @click="cartDecreaseQuantity(item.id)">
                                  <i class="fas fa-minus"></i>
                                </button>
      
                                <input type="text" class="form-control text-center border border-secondary" :value="item.quantity" aria-label="Quantity" aria-describedby="button-addon1" />
                                <button class="btn btn-outline-secondary px-3" type="button" id="button-addon2" @click="cartIncreaseQuantity(item.id)">
                                  <i class="fas fa-plus"></i>
                                </button>
                              </div>
                            </div>
      
        
                            <div class="remove-item" style="margin-top: 8px;">
                              <button @click="removeItem(item.id)" class=" btn btn-danger" style="border-radius: 50%; padding: 4px 9px; border: none;">
                                <i class="fas fa-trash-alt"></i>
                              </button>
                            </div>
                          </div>
                          </div>
                      </div>

                        <div class="col-md-6 col-sm-12">
                          <div class="addressContainer">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                              <label class="form-check-label" for="flexRadioDefault2">
                                Sri Krishna Nilaya, 14th B Cross Road, Byrasandra, GM Palya, CV Raman Nagar, Bangalore
                              </label>
                            </div>
                            <div class="d-flex justify-content-between">
                              <div></div>
                              <button @click="addAddress" type="button" class="btn btn-primary" style="font-size: 13px;">Add New Address</button>
                              <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Open second modal</button>
                            </div>
                          </div>
                        </div>




                        

                        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <form>
                                  <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Recipient:</label>
                                    <input type="text" class="form-control" id="recipient-name">
                                  </div>
                                  <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Message:</label>
                                    <textarea class="form-control" id="message-text"></textarea>
                                  </div>
                                </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Send message</button>
                              </div>
                            </div>
                          </div>
                        </div>



                    </div>
                  </div>
                  <div class="modal-footer d-flex justify-content-between">
                    <div class="d-flex flex-column">
                      <h4>Total</h4>
                      <div class="d-flex">
                        <h5 style="margin-right: 8px; color: #28a745; font-size: 1.2rem; font-weight: 500;">Price : </h5>
                        <p style="margin-right: 8px; color: #28a745; font-size: 1rem; font-weight: 500;">{{totalDicountPrice}}</p>
                        <span class="text-danger">
                          <s>{{ totalPrice}}</s>
                          </span>
                      </div>
                    </div>
                    <div class="d-flex">
                      <div style="background-color: #f8f9fa; border-top: 2px solid #dee2e6; margin-right: 5px;">
                        <button type="button" class="checkout btn btn-primary">Proceed to Checkout</button>
                      </div>
                      <button type="button" class="btn btn-secondary" @click="myCartVisible = false" data-bs-dismiss="modal">Close</button>
                    </div>
  
                  </div>
  
                </div>
              </div>
            </div>
</template>