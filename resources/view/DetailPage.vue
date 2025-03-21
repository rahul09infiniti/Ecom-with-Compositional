<template>
  
    <div id="productDetails">
      <header class="sticky-header">
        

          <page-header :cart="cart"  :updateWishList="updateWishList" :key="`${totalWishlistProduct}-${totalCartItem}`">
          </page-header>
          
          <div style="background-color: #033143; margin-top: 70px;">           
            <div class="container py-4">
                <!-- Breadcrumb -->
                <nav class="d-flex">
                    <h6 class="mb-0">
                      <a href="../../app_page/home_page/index.php" style="color: white;">Home</a>
                      <span class="text-white-50 mx-2"> > </span>
                      <a href="" class="text-white"><u>Product Details</u></a>
                    </h6>
                </nav>
                    <!-- Breadcrumb -->        
            </div>        
          </div>
                    

      </header>

          <!-- My wishList -->

          <div v-show="myWishListVisible" :class="{'background-fade': myWishListVisible}"  class="background-overlay modal fade show" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block;">
            <div  class="modal-dialog modal-lg">
              <div  class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title fs-5" id="exampleModalLabel" style="font-weight: bold; color: #333;">Your wishList</h5>
                  <button type="button" class="btn-close" @click="myWishListVisible = false" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="max-height: 400px; overflow-y: auto; padding: 20px;">
                  <div v-for="item in wishList" :key="item.id" class="cart-item d-flex justify-content-between align-items-center mb-3 p-3" style="border-bottom: 1px solid #dee2e6;">
                    <div class="cart-item-image" style="width: 70px; height: 70px; overflow: hidden; margin-right: 15px; border-radius: 8px;">
                      <img :src="item.images[0]" alt="Product Image" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                    </div>
                    <div class="cart-item-details flex-grow-1 d-flex flex-column ">
                      <h4 class="mb-1" style="font-size: 1.1rem; color: #333; font-weight: bold;">{{ item.title }}</h4>
                      

                      <div class=" d-flex  mb-3">

                        <div><p v-if="item.discountPrice" style="margin-right: 10px; color: #28a745; font-size: 1rem; font-weight: 500;"> Price : ${{ (item.discountPrice && item.quantity) ? (item.discountPrice * item.quantity).toFixed(2) : '0.00' }}
                        </p></div>
                        <div>
                          <span class="text-danger" style="font-size: 1rem;"> 
                            <s>  ${{ (item.price && item.quantity) ? (item.price * item.quantity).toFixed(2) : '0.00' }}</s>
                          </span>
                        </div>
                      </div>
                    </div>

                    <div class="d-flex justify-content-center align-items-center">
                      <div class="cart-item-quantity" style="text-align: center; margin-right: 14px;">
                        <label class="mb-2 d-block" style="font-size: 0.9rem;">Quantity</label>
                        <div class="input-group mb-3" style="width: 150px;">
                          <button class="btn btn-outline-secondary px-3" type="button" id="button-addon1" @click="wishListDecreaseQuantity(item.id)">
                            <i class="fas fa-minus"></i>
                          </button>

                          <input type="text" class="form-control text-center border border-secondary" :value="item.quantity" aria-label="Quantity" aria-describedby="button-addon1" />
                          <button class="btn btn-outline-secondary px-3" type="button" id="button-addon2" @click="wishListIncreaseQuantity(item.id)">
                            <i class="fas fa-plus"></i>
                          </button>
                        </div>
                      </div>

                      <button @click="moveToCart(item)" type="button" class="checkout btn btn-primary" style="margin-top: 13px; margin-right: 10px;">Move to Cart</button>
  
                      <div class="remove-item" style="margin-top: 8px;">
                        <button @click="removeItemFromWishList(item.id)" class=" btn btn-danger" style="border-radius: 50%; padding: 4px 9px; border: none;">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                      </div>
                    </div>
                    </div>
                </div>

              <!-- Alert Modal -->

                <div v-show="showAlertModal" :class="{'background-fade': myWishListVisible}" class="modal fade show" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block;">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" @click="showAlertModal = false" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        {{modalMessage}}
                      </div>
                      <div class="modal-footer">
                        <button type="button" @click="showAlertModal = false" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="button" @click="confirmMoveToCart()" class="btn btn-primary">Yes</button>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="modal-footer d-flex ">
                  <div class="d-flex">
                    <button type="button" class="btn btn-secondary" @click="myWishListVisible = false" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- My cart List -->
          
          <!-- <div v-show="myCartVisible" :class="{'background-fade': myCartVisible}"  class="background-overlay modal fade show" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block;">
            <div  class="modal-dialog modal-lg">
              <div  class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title fs-5" id="exampleModalLabel" style="font-weight: bold; color: #333;">My Cart</h5>
                  <button type="button" class="btn-close" @click="myCartVisible = false" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="max-height: 400px; overflow-y: auto; padding: 20px;">
                  <div v-for="item in cart" :key="item.id" class="cart-item d-flex justify-content-between align-items-center mb-3 p-3" style="border-bottom: 1px solid #dee2e6;">
                    <div class="cart-item-image" style="width: 70px; height: 70px; overflow: hidden; margin-right: 15px; border-radius: 8px;">
                      <img :src="item.images[0]" alt="Product Image" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                    </div>

                    <div class="cart-item-details flex-grow-1 d-flex flex-column ">
                      <h4 class="mb-1" style="font-size: 1.1rem; color: #333; font-weight: bold;">{{ item.title }}</h4>

                      <div class=" d-flex  mb-3">

                        <div><p v-if="item.discountPrice" style="margin-right: 10px; color: #28a745; font-size: 1rem; font-weight: 500;"> Price : ${{ (item.discountPrice && item.quantity) ? (item.discountPrice * item.quantity).toFixed(2) : '0.00' }}
                        </p></div>
                        <div>
                          <span class="text-danger" style="font-size: 1rem;"> 
                            <s> ${{ (item.price && item.quantity) ? (item.price * item.quantity).toFixed(2) : '0.00' }}</s>
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
                <div class="modal-footer d-flex justify-content-between">
                  <div class="d-flex flex-column">
                    <h4>Total</h4>
                    <div class="d-flex">
                      <h5 style="margin-right: 8px; color: #28a745; font-size: 1.2rem; font-weight: 500;">Price : </h5>
                      <p style="margin-right: 8px; color: #28a745; font-size: 1rem; font-weight: 500;">${{ (totalDicountPrice && !isNaN(totalDicountPrice)) ? totalDicountPrice.toFixed(2) : '0.00' }}
                      </p>
                      <span class="text-danger">
                        <s>${{ (totalPrice && !isNaN(totalPrice)) ? totalPrice.toFixed(2) : '0.00' }}
                        </s>
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
          </div> -->
        
   
          
          <!-- content -->
          <section v-if="productInfo" class="py-5" style="margin-top: 130px;">
            <div  class="container">
              <div class="row gx-5">
                <aside class="col-lg-6">
                  <div class="border rounded-4 mb-3 d-flex justify-content-center">
                    <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image" :href ="productInfo.images[0]">
                      <img :src="productInfo.images[0]" style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" />
                    </a>
                  </div>
                  <div class="d-flex justify-content-center mb-3">
                    <a data-fslightbox="mygalley" class="border mx-1 rounded-2 item-thumb" target="_blank" data-type="image" :href ="productInfo.images[0]">
                      <img :src="productInfo.images[0]" width="60" height="60" class="rounded-2"  />
                    </a>
                    <a data-fslightbox="mygalley" class="border mx-1 rounded-2 item-thumb" target="_blank" data-type="image" :href = "productInfo.images[0]" >
                      <img :src="productInfo.images[0]" width="60" height="60" class="rounded-2"  />
                    </a>
                    <a data-fslightbox="mygalley" class="border mx-1 rounded-2 item-thumb" target="_blank" data-type="image" :href="productInfo.images[0]">
                      <img :src="productInfo.images[0]" width="60" height="60" class="rounded-2"  />
                    </a>
                    <a data-fslightbox="mygalley" class="border mx-1 rounded-2 item-thumb" target="_blank" data-type="image" :href="productInfo.images[0]">
                      <img :src="productInfo.images[0]" width="60" height="60" class="rounded-2"  />
                    </a>
                    <a data-fslightbox="mygalley" class="border mx-1 rounded-2 item-thumb" target="_blank" data-type="image" :href="productInfo.images[0]">
                      <img :src="productInfo.images[0]" width="60" height="60" class="rounded-2" />
                    </a>
                  </div>
                  <!-- thumbs-wrap.// -->
                  <!-- gallery-wrap .end// -->
                </aside>
                <main class="col-lg-6">
                  <div class="ps-lg-3">
                    <h4 class="title text-dark">
                      {{productInfo.title}}
                    </h4>
                    <div class="d-flex flex-row my-3">
                      <div class="text-warning mb-1 me-2">
                        <span v-for="num in Math.floor(productInfo.rating)">
                          <i class="fa fa-star"></i>
                        </span>
                        
                        <span v-if="productInfo.rating > Math.floor(productInfo.rating)">
                          <i class="fa fa-star-half-alt"></i>
                        </span>
                        
                        <span class="ms-1">{{productInfo.rating}}
                        
                        </span>
                      </div>
                      <span class="text-muted"><i class="fa fa-shopping-basket fa-sm mx-1"></i>{{productInfo.stock}}</span>
                      <span class="text-success ms-2">In stock</span>
                    </div>
          
                    <!-- pricing -->
                    <div class=" d-flex align-items-center mb-3">
                      <h4 class="mb-1 me-1">
                        ${{ discountPrice = (productInfo.price - (productInfo.price * productInfo.discountPercentage / 100)).toFixed(2) }}
                        </h4>
                        <span class="text-danger">
                          <s>${{ productInfo.price }}</s>
                        </span>
                      <span class="text-muted">/per box</span>
                    </div>
          
                    <p>
                      {{productInfo.description}}
                    </p>

                    <p>
                      <li class="text-success">
                        <strong class="text-success" style="font-size: 18px;" >{{productInfo.shippingInformation}}</strong>
                      </li>
                    </p>

                      <!-- <p><strong style="color:#3b71ca; font-size: 18px;">{{productInfo.shippingInformation}}</strong></p> -->


                      <!-- <button type="button" class="btn btn-primary position-relative">
                        Profile
                        <span class="position-absolute top-50 start-0 translate-middle p-2 bg-danger border border-light rounded-circle">
                        </span>
                      </button> -->
                    
          
                    <div class="row">
                      <dt class="col-3">Type:</dt>
                      <dd class="d-flex col-9">
            
                        <li style="margin-right: 8px;" v-for="tag in productInfo.tags">{{tag}}</li>
                      </dd>
          
                    
                      <dt class="col-3">Brand</dt>
                      <dd class="col-9">{{productInfo.brand}}</dd>


                      <dt class="col-3">ReturnPolicy</dt>
                      <dd class="col-9">{{productInfo.returnPolicy}}</dd>

                      <dt class="col-3">Warranty</dt>
                      <dd class="col-9">{{productInfo.warrantyInformation}}</dd>

                      <dt class="col-3 d-flex">Dimensions</dt>
                        <dd class="col-9">Width : {{productInfo.dimensions.width}}cm,  Height : {{productInfo.dimensions.height}}cm, Depth : {{productInfo.dimensions.depth}}cm</dd>

                    </div>
          
                    <hr />
          
                    <div class="row mb-4">
                      <div class="col-md-4 col-6">
                        <label class="mb-2">Size</label>
                        <select class="form-select border border-secondary" style="height: 35px;">
                          <option>Small</option>
                          <option>Medium</option>
                          <option>Large</option>
                        </select>
                      </div>
                      <!-- col.// -->
                      <div class="col-md-4 col-6 mb-3">
                        <label class="mb-2 d-block">Quantity</label>
                        <div class="input-group mb-3" style="width: 170px;">
                          <button class="btn btn-white border border-secondary px-3" type="button" id="button-addon1" data-mdb-ripple-color="dark">
                            <i @click="decreaseQuantity" class="fas fa-minus"></i>
                          </button>
                          <div type="text" class="form-control text-center border border-secondary"  aria-label="Example text with button addon" aria-describedby="button-addon1">
                            {{placeholder}}
                          </div>
                          <!-- <input type="text" class="form-control text-center border border-secondary" placeholder="1" aria-label="Example text with button addon" aria-describedby="button-addon1" /> -->
                          <button class="btn btn-white border border-secondary px-3" type="button" id="button-addon2" data-mdb-ripple-color="dark">
                            <i @click="increaseQuantity" class="fas fa-plus"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                    <a href="#" class="btn btn-warning shadow-0"> Buy now </a>
                    <a @click="addToCart" href="#" class="btn btn-primary" style="margin: 0px 15px; background-color: #04a9f5; border: none;"> <i class="me-1 fa fa-shopping-basket"  aria-label="Add to Cart"></i> {{cartButtonText}} </a>
                    <a @click="saveToWishList" href="#" class="btn btn-light border border-secondary py-2 px-3"> <i :class="['me-1', 'fa', 'fa-heart', 'fa-lg', { 'text-danger': isInWishList }]"></i> {{saveButtonText}} </a>
                    
                  </div>
                </main>
              </div>
            </div>
          </section>
            <section v-if="productInfo" class="bg-light border-top py-4">
              <div  class="container">
                <div class="row gx-4" >
                  <div class="col-lg-8 mb-4">
                    <div class="border rounded-2 px-3 py-2 bg-white">
                      <!-- Pills navs -->
                      <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                        <li class="nav-item d-flex" role="presentation">
                          <a :class="['nav-link', {'active' : activeTab === 1}]" @click="setActiveTab(1)" :style="activeTab === 1 ? {color: 'white', backgroundColor: '#04a9f5'} : {color: '#04a9f5', backgroundcolor: 'white' }" class="nav-link d-flex align-items-center justify-content-center w-100" id="ex1-tab-1" data-bs-toggle="pill" href="#ex1-pills-1" role="tab" aria-controls="ex1-pills-1" aria-selected="flase">Description</a>
                        </li>
                        <li class="nav-item d-flex" role="presentation">
                          <a :class="['nav-link', {'active' : activeTab === 2}]" @click="setActiveTab(2)" :style="activeTab === 2 ? {color: 'white', backgroundColor: '#04a9f5'} : {color: '#04a9f5', backgroundcolor: 'white' }" class="nav-link d-flex align-items-center justify-content-center w-100" id="ex1-tab-4" data-bs-toggle="pill" href="#ex1-pills-4" role="tab" aria-controls="ex1-pills-4" aria-selected="false">Reviews</a>
                        </li>
                        <li class="nav-item d-flex" role="presentation">
                          <a :class="['nav-link', {'active' : activeTab === 3}]" @click="setActiveTab(3)" :style="activeTab === 3 ? {color: 'white', backgroundColor: '#04a9f5'} : {color: '#04a9f5', backgroundcolor: 'white' }" class="nav-link d-flex align-items-center justify-content-center w-100" id="ex1-tab-2" data-bs-toggle="pill" href="#ex1-pills-2" role="tab" aria-controls="ex1-pills-2" aria-selected="true">Warranty info</a>
                        </li>
                        <li class="nav-item d-flex" role="presentation">
                          <a :class="['nav-link', {'active' : activeTab === 4}]" @click="setActiveTab(4)" :style="activeTab === 4 ? {color: 'white', backgroundColor: '#04a9f5'} : {color: '#04a9f5', backgroundcolor: 'white' }" class="nav-link d-flex align-items-center justify-content-center w-100" id="ex1-tab-3" data-bs-toggle="pill" href="#ex1-pills-3" role="tab" aria-controls="ex1-pills-3" aria-selected="false">Shipping info</a>
                        </li>
                        
                      </ul>
                      <!-- Pills navs -->
            
                      <!-- Pills content -->
                      <div class="tab-content" id="ex1-content" style="overflow-y: auto; max-height: 400px;">
                        <div class="tab-pane fade show active" id="ex1-pills-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                          <p>
                           {{productInfo.description}}
                          </p>
                          
                          <table class="table border mt-3 mb-2">
                            <tr>
                              <th class="py-2">Brand:</th>
                              <td class="py-2">{{productInfo.brand}}</td>
                            </tr>
                            <tr>
                              <th class="py-2">ReturnPolicy:</th>
                              <td class="py-2">{{productInfo.returnPolicy}}</td>
                            </tr>
                            <tr>
                              <th class="py-2">Dimensions:</th>
                              <td class="py-2">Width : {{productInfo.dimensions.width}}cm,  Height : {{productInfo.dimensions.height}}cm, Depth : {{productInfo.dimensions.depth}}cm</td>
                            </tr>
                            <tr>
                              <th class="py-2">Minimum order Quantity</th>
                              <td class="py-2">{{productInfo.minimumOrderQuantity}}</td>
                            </tr>
                            <tr>
                              <th class="py-2">Weight</th>
                              <td class="py-2">{{productInfo.weight}}</td>
                            </tr>
                          </table>
                        </div>
                        <div class="tab-pane fade" id="ex1-pills-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                          <h5>{{productInfo.warrantyInformation}} </h5>
                        </div>
                        <div class="tab-pane fade" id="ex1-pills-3" role="tabpanel" aria-labelledby="ex1-tab-3">
                          <h5>{{productInfo.shippingInformation}}</h5>
                        </div>


                        <div class="tab-pane fade" id="ex1-pills-4" style="overflow-y: auto; max-height: 400px;" role="tabpanel" aria-labelledby="ex1-tab-4">
                          <div v-for="review in productInfo.reviews" style="border-bottom: 2px solid #dee2e6; padding-bottom: 20px; margin-bottom: 20px; font-family: Arial, sans-serif; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                              <h5 style="font-size: 1.2rem; color: #333; font-weight: bold; margin-bottom: 10px;">{{review.reviewerName}}</h5>
                              <div class="text-warning mb-1 me-2" style="font-size: 1.1rem; color: #f39c12;">
                                  <span v-for="num in Math.floor(review.rating)">
                                      <i class="fa fa-star"></i>
                                  </span>
                      
                                  <span v-if="review.rating > Math.floor(review.rating)">
                                      <i class="fa fa-star-half-alt"></i>
                                  </span>
                      
                                  <span class="ms-1" style="font-size: 1rem; color: #6c757d;">{{review.rating}}</span>
                              </div>
                      
                              <p style="font-size: 1rem; line-height: 1.5; color: #555; margin-bottom: 15px;"><strong>{{review.comment}}</strong></p>
                              <p style="font-size: 0.9rem; color: #999; font-style: italic;">
                                  <strong>{{ new Date(review.date).toLocaleString('en-US',{
                                      month: 'short',
                                      day: 'numeric',
                                      year: 'numeric',
                                      hour: '2-digit',
                                      minute: '2-digit',
                                      hour12: true
                                  }) }}</strong>
                              </p>
                          </div>

                          <!-- for showing custom user review -->

                          <div v-for="eachUserReview in userReviewList" style="border-bottom: 2px solid #dee2e6; padding-bottom: 20px; margin-bottom: 20px; font-family: Arial, sans-serif; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                            <div class="d-flex justify-content-between">
                              <h5 style="font-size: 1.2rem; color: #333; font-weight: bold; margin-bottom: 10px;">{{eachUserReview.username}}</h5>
                              <i @click="editReview" class="fa fa-edit" style="font-size:20px; cursor: pointer; margin-right: 15px;"></i>
                            </div>
                            <div class="text-warning mb-1 me-2" style="font-size: 1.1rem; color: #f39c12;">
                              <span v-for="num in Math.floor(eachUserReview.rating)" :key="'star' + num">
                                <i class="fa fa-star"></i>
                              </span>
                        
                              <span v-if="eachUserReview.rating > Math.floor(eachUserReview.rating)">
                                <i class="fa fa-star-half-alt"></i>
                              </span>
                        
                              <span class="ms-1" style="font-size: 1rem; color: #6c757d;">{{eachUserReview.rating}}</span>
                            </div>

                              <p style="font-size: 1rem; line-height: 1.5; color: #555; margin-bottom: 15px;"><strong>{{eachUserReview.comment}}</strong></p>
                            
                          </div>
                         
                          

                          <!-- write review, modal -->
                          
                          <div v-show="showReviewModal"  :class="{'background-fade': showReviewModal}" class="modal fade show" id="exampleModalreview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Write Review</h1>
                                  <button type="button" class="btn-close" @click="showReviewModal = false" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <form>
                                    <div class="mb-3">
                                      <label for="recipient-name" class="col-form-label">User Name</label>
                                      <input type="text" v-model="username" class="form-control" id="recipient-name">
                                    </div>
                                    <div class="mb-3">
                                      <label for="message-text" class="col-form-label">Comment</label>
                                      <textarea class="form-control" v-model="comment" id="message-text"></textarea>
                                    </div>

                                    <div class="mb-3" style="margin-left: 40%;">
                                      <i v-for="star in 5" :key="star" :class="['fa', 'fa-star', {'filled' : star <= currentRating}]" @click="setRating(star)" class=" fa fa-star"></i>
                                    </div>
                                  </form>
                                </div>
                                <div class="modal-footer">
                                  <button @click="postReview" type="button" class="btn btn-primary" data-bs-dismiss="modal" style="background-color: #04a9f5; color: white; border: none;">Post Review</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalreview" style="background-color: #04a9f5; color: white; border: none;"  @click="writeReview">Write Review</button>
                          </div> 
                         

                      </div>
                     
                      
                      </div>
                      <!-- Pills content -->

                      
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="px-0 border rounded-2 shadow-0">
                      <h5 class="card-title"  style="font-size: 1.3rem; margin-top: 12px; margin-left: 10px; margin-bottom: 8px;" >Similar items</h5>
                      <div v-if="productInfo" class="card"  style=" max-height: 400px; overflow-y: auto;">
                        <div v-for="simiProduct in similarProducts" :key="simiProduct.id" @click="selectSimilarProduct(simiProduct)" class="card-body p-3" style="border-bottom: 1px solid #dee2e6;">
                          <div class="similar-product d-flex mb-1">
                            <a href="#" class="me-3">
                              <img :src="simiProduct.thumbnail" style="min-width: 96px; height: 96px; object-fit: cover; border-radius: 4px;" class="img-md img-thumbnail" />
                            </a>
                            <div class="info">
                              <a @click.prevent="selectSimilarProduct(simiProduct)" href="#" class="similar-nav nav-link mb-1 no-hover-background" style="font-size: 1rem; font-weight: bold; color: #333;">
                                {{ simiProduct.title }}
                              </a>
                              <strong class="text-dark" style="font-size: 1.1rem; color: #333;">${{ simiProduct.price.toFixed(2) }}</strong>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>


            <!-- Footer -->
            <page-footer></page-footer>
          <!-- Footer -->

    

    </div>
</template>

<script type="module">
// import DetailHeader from '../components/DetailHeader.vue'
import Header from '../components/Header.vue'
import Footer from '../components/Footer.vue';
    import { ref, computed, onMounted } from 'vue';

    export default{
      components:{
        // 'detail-header' : DetailHeader,
        'page-header' : Header,
        'page-footer' : Footer
      },
        setup(){
          const totalVisitCount = ref(0);
          const visitedProduct = ref([]);
          const childRef = ref(null);
          const totalWishlistProduct = ref(0);
          const discountPrice = ref(0); 
          const totalCartItem = ref(0);
            const getUsernameFromStorage = () => {
                const storedUsername = localStorage.getItem('currentUsername');
                return storedUsername ? storedUsername : 'guest';
            };

            const isLoggedIn = ref(false);
            const enteredEmail = ref('');
            const enteredUsername = ref('');
            const enteredPassword = ref('');
            const enteredConfirmPassword = ref('');
            const currentUsername = ref(getUsernameFromStorage());

            const showSignLoginModal = ref(false);
            const showCreateAccountModal = ref(false);

            const productInfo = ref(null);
            const productId = ref(null);
            const enteredProductTitle = ref('');
            const InputSuggestionProduct = ref([]);
            const placeholder = ref(1);
            const cart = ref([]);
            const wishList = ref([]);
            const cartButtonText = ref('Add to cart');
            const saveButtonText = ref('Save');
            const myCartVisible = ref(false);
            const myWishListVisible = ref(false);
            const isInWishList = ref(false);
            const showAlertModal = ref(false);
            const modalMessage = ref('');
            const similarProducts = ref([]);
            const activeTab = ref(1);
            const showReviewModal = ref(false);
            const currentRating = ref(0);
            const userReviewList = ref([]);
            const username = ref('');
            const comment = ref('');


      

            const totalProductCount = computed(() => {
                return cart.length;
            });

            const totalWishListCount = computed(() => {
                return wishList.length;
            });
           
            const totalDiscountPrice = computed(() => {
              return cart.value.reduce((discountSum, item) => discountSum + item.discountPrice * item.quantity, 0);
            });
            
            
            onMounted(() => {
                checkLoginState();
                const urlParams = new URLSearchParams(window.location.search);
                productId.value = urlParams.get('id');
                
                console.log('Product ID from URL:', productId.value);
                loadCartFromLocalStorage();
                loadReviewFirst();
                fetchProductDetails();
            });

            const updateWishList = (updatedWishList) => {
              wishList.value = updatedWishList;
              saveButtonText.value = 'Save'
            };


            const handleItemRemoved = (itemId) => {
              const itemIndex = wishList.findIndex(item => item.id === itemId);
              if (itemIndex !== -1) {
                wishList.splice(itemIndex, 1);
              }

              isInWishList.value = wishList.some(item => item.id === itemId);
              
              localStorage.setItem('wishList', JSON.stringify(wishList));
            };


            const signIn = () => {
                showSignLoginModal.value = true;
             };

            const createAccount = () => {
                showCreateAccountModal.value = true;
            };

            const createNewUserAccount = () => {
                if (enteredEmail.value && enteredUsername.value && enteredPassword.value && enteredConfirmPassword.value) {
                    if (enteredPassword.value === enteredConfirmPassword.value) {
                        const newUser = {
                            email: enteredEmail.value,
                            username: enteredUsername.value,
                            password: enteredPassword.value,
                        };
                        const createdUser = JSON.parse(localStorage.getItem('newUser')) || [];
                        const userExist = createdUser.find(user => user.email === enteredEmail.value);

                        if (userExist) {
                            alert("This email is already registered");
                            return;
                        }

                        createdUser.push(newUser);
                        localStorage.setItem('newUser', JSON.stringify(createdUser));
                        isLoggedIn.value = true;
                        currentUsername.value = enteredUsername.value;

                        localStorage.setItem('currentUsername', enteredUsername.value);
                        alert("account created successfully");

                        showCreateAccountModal.value = false;
                        showSignLoginModal.value = false;
                    } else {
                        alert("password not matched");
                    }
                } else {
                    alert("fill all the field");
                }
            };

           

            const loginUser = () => {
                const enteredEmail = enteredEmail.value;
                const enteredPassword = enteredPassword.value;

                const createdUser = JSON.parse(localStorage.getItem('newUser')) || [];
                const user = createdUser.find(user => user.email === enteredEmail);

                if (user) {
                    if (user.password === enteredPassword) {
                        localStorage.setItem('currentUsername', user.username);
                        currentUsername.value = user.username;
                        isLoggedIn.value = true;
                        showSignLoginModal.value = false;
                        alert("login successfully");
                    } else {
                        alert("incorrect password!");
                    }
                } else {
                    alert("user not found");
                }
            };

            const signOut = () => {
                currentUsername.value = 'guest';
                isLoggedIn.value = false;
                localStorage.removeItem('currentUsername');
                alert("user logged out successfully");
            };

            const checkLoginState = () => {
                const storedUsername = localStorage.getItem('currentUsername');
                if (storedUsername) {
                    isLoggedIn.value = true;
                    currentUsername.value = storedUsername;
                } else {
                    isLoggedIn.value = false;
                    currentUsername.value = 'guest';
                }
            };

            const fetchProductDetails = async () => {
                if (!productId.value) return;

                try {
                    const response = await fetch(`https://dummyjson.com/products/${productId.value}`);
                    const data = await response.json();
                    productInfo.value = data;
                    console.log("my product", productInfo.value);
                    await getSimilarProduct();

                    checkProductInCartForAdded();
                    checkProductInWishList();
                    // this.postReview();

                    console.log('fetched product', productInfo.value);

                   
                } catch (error) {
                    console.log("Error fetching product details", error);
                }
            };

            const getProduct = async () => {
                if (enteredProductTitle.value.trim() === '') {
                    alert("Please enter product title");
                    return;
                }

                try {
                    const response = await fetch(`https://dummyjson.com/products/search?q=${enteredProductTitle.value}`);
                    const data = await response.json();

                    console.log("getproduct", data);
                    if (data && data.products && data.products.length > 0) {
                        productInfo.value = data.products[0];

                        checkProductInCartForAdded();
                        checkProductInWishList();

                    } else {
                        alert("Product not found");
                    }
                } catch (error) {
                    console.log("Error fetching product", error);
                }
            };

            const searchInputProduct = async () => {
                clearTimeout(debounceTimeout.value);

                if (abortController.value) {
                    abortController.value.abort();
                }

                abortController.value = new AbortController();

                debounceTimeout.value = setTimeout(async () => {
                    if (enteredProductTitle.value.length >= 3) {
                        try {
                            const response = await fetch(`https://dummyjson.com/products/search?q=${enteredProductTitle.value}`, {
                                signal: abortController.value.signal
                            });
                            if (response.ok) {
                                const data = await response.json();
                                InputSuggestionProduct.value = data.products;
                                filtersApplied.value = true;
                            }
                        } catch (error) {
                            if (error.name !== 'AbortError') {
                                console.log("Error fetching suggestions:", error);
                            }
                        }
                    } else {
                        // Clearing suggestions if input length is less than 3 characters
                        InputSuggestionProduct.value = [];
                    }
                }, 500);
            };

            const selectSuggestion = (product) => {
                clearTimeout(debounceTimeout.value);

                if (abortController.value) {
                    abortController.value.abort();
                }

                enteredProductTitle.value = product.title;
                InputSuggestionProduct.value = [];
                ecommerceData.value = [product];
            };


            const increaseQuantity = () => {
                placeholder.value++;
                cartButtonText.value = 'Updated Cart';
            };

            const decreaseQuantity = () => {
                if (placeholder.value >= 2) {
                    placeholder.value--;
                    cartButtonText.value = 'Updated Cart';
                }
            };

            const loadCartFromLocalStorage = () => {
                const cartData = JSON.parse(localStorage.getItem('cart'));
                console.log("Loaded cart data:", cartData);

                if (cartData) {
                    cart.value = cartData;
                }

                const wishListData = JSON.parse(localStorage.getItem('wishList'));
                if (wishListData && Array.isArray(wishListData) && wishListData.length > 0) {
                    wishList.value = wishListData;
                } else {
                    console.log("No Data to display!!!!!");
                }
            };

            const addToCart = () => {
              totalCartItem.value++;
              console.log("cart calling");
              
              if (productInfo.value) {
                let cart = JSON.parse(localStorage.getItem('cart')) || [];

                const existingProduct = cart.find(item => item.id === productInfo.value.id);

                if (!existingProduct) {
                  const discountPrice = (productInfo.value.price - (productInfo.value.price * productInfo.value.discountPercentage / 100)).toFixed(2);
                  const cartItem = {
                    id: productInfo.value.id,
                    title: productInfo.value.title,
                    images: productInfo.value.images,
                    discountPrice: discountPrice,
                    price: productInfo.value.price,
                    quantity: placeholder.value
                  };

                  cart.push(cartItem);
                  console.log("discount price", productInfo.value.discountPrice);
                  console.log("image", productInfo.value.images);
                  
                  localStorage.setItem('cart', JSON.stringify(cart));
                  cart.value = cart;
                  

                } else {
                  existingProduct.quantity = placeholder.value;
                }

                // calculateTotalDiscountPrice(cart);
                

                checkProductInCartForAdded();
              }
            };


            // const calculateTotalDiscountPrice = (cart) => {
            //   totalDicountPrice.value = cart.reduce((acc, item) => acc + (item.discountPrice * item.quantity), 0);  
            // };

            



            const saveToWishList = () => {
              totalWishlistProduct.value++;
              console.log("wishlist calling");

              if (productInfo.value) {
                const wishList = JSON.parse(localStorage.getItem('wishList')) || [];

                const existingWishListProduct = wishList.find(item => item.id === productInfo.value.id);
                
                if (!existingWishListProduct) {
                  const discountPrice = (productInfo.value.price - (productInfo.value.price * productInfo.value.discountPercentage / 100)).toFixed(2);

                  const wishListItem = {
                    id: productInfo.value.id,
                    title: productInfo.value.title,
                    images: productInfo.value.images,
                    discountPrice: discountPrice,
                    price: productInfo.value.price,
                    quantity: placeholder.value
                  };

                  wishList.push(wishListItem);
                  
                  localStorage.setItem('wishList', JSON.stringify(wishList));
                  wishList.value = wishList;

                  isInWishList.value = true;
                  saveButtonText.value = "Saved";
                 
                  checkProductInWishList(); 
                }
              }
            };




            const showMyCart = () => {
                console.log("my cart calling");
                myCartVisible.value = !myCartVisible.value;

                if(myCartVisible.value){
                  const storedCart = JSON.parse(localStorage.getItem('cart')) || [];
                  cart.value = storedCart;
                }
            };

            const showMyWishList = () => {
              myWishListVisible.value = !myWishListVisible.value;
              if (myWishListVisible.value) {
              const storedWishList = JSON.parse(localStorage.getItem('wishList')) || [];
              wishList.value = storedWishList;
            }
            };

            const checkProductInCartForAdded = () => {
                const cart = JSON.parse(localStorage.getItem('cart')) || [];
                const existingProduct = cart.find(item => item.id == productInfo.value.id);

                if (existingProduct) {
                    console.log("Product is in cart:", existingProduct);
                    cartButtonText.value = 'Added';
                } else {
                    console.log("Product is NOT in cart.");
                    cartButtonText.value = 'Add to cart';
                }
            };

            const checkProductInWishList = () => {
                const wishList = JSON.parse(localStorage.getItem('wishList')) || [];
                const existingProduct = wishList.find(item => item.id == productInfo.value.id);

                if (existingProduct) {
                    console.log("product is in wishlist", existingProduct);
                    saveButtonText.value = "Saved";
                    isInWishList.value = true;
                    console.log(saveButtonText.value);
                } else {
                  if (childRef.value) {
                      childRef.value.removeItemFromWishList(); 
                    }
                    saveButtonText.value = "Save";
                    isInWishList.value = false;
                }
            };

            const saveToLocalStorage = () => {
                localStorage.setItem('cart', JSON.stringify(cart));
                localStorage.setItem('wishList', JSON.stringify(wishList));
            };

            const removeItem = (itemId) => {
                const updatedCart = cart.value.filter(item => item.id !== itemId);
                cart.value = updatedCart;

                localStorage.setItem('cart', JSON.stringify(updatedCart));

                cartButtonText.value = 'Add to cart';
            };


           

            

            const wishListIncreaseQuantity = (itemId) => {
                const item = wishList.value.find(item => item.id === itemId);
                if (item) {
                    item.quantity++;
                    saveToLocalStorage();
                }
            };

            const wishListDecreaseQuantity = (itemId) => {
                const item = wishList.value.find(item => item.id === itemId);
                if (item && item.quantity > 1) {
                    item.quantity--;
                    saveToLocalStorage();
                }
            };

            const moveToCart = (item) => {
                console.log("move to crt");
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                let wishList = JSON.parse(localStorage.getItem('wishList')) || [];

                const existingProductInCart = cart.find(cartItem => cartItem.id === item.id);
                if (existingProductInCart) {
                    showAlertModal.value = true;
                    modalMessage.value = "This product is already in the cart, Do you want to update it";
                    itemToMove.value = item;
                } else {
                    cart.push(item);
                    isInWishList.value = false;
                    cartButtonText.value = "Added";

                    wishList = wishList.filter(wishListItem => wishListItem.id !== item.id);

                    localStorage.setItem('cart', JSON.stringify(cartData));
                    localStorage.setItem('wishList', JSON.stringify(wishListData));

                    cart.value = cart;
                    wishList.value = wishList;
                }
            };

            const confirmMoveToCart = () => {
                const cart = JSON.parse(localStorage.getItem('cart')) || [];
                let wishList = JSON.parse(localStorage.getItem('wishList')) || [];
                const item = itemToMove.value;

                const existingProductInCart = cart.find(cartItem => cartItem.id === item.id);

                if (existingProductInCart) {
                    existingProductInCart.quantity = item.quantity;
                    wishList = wishList.filter(wishListItem => wishListItem.id !== item.id);

                    localStorage.setItem('cart', JSON.stringify(cartData));
                    localStorage.setItem('wishList', JSON.stringify(wishListData));

                   cart.value = cartButtonText;
                   wishList.value = wishList;

                    isInWishList.value = false;
                    cartButtonText.value = "Added";
                    showAlertModal.value = false;
                } else {
                    showAlertModal.value = false;
                }
            };

            const setActiveTab = (currentActiveTab) => {
                activeTab.value = currentActiveTab;
            };

            const getSimilarProduct = async () => {
              console.log("similr product");
              
                console.log("info cat", productInfo.value.category);
                
                try {
                    const response = await fetch(`https://dummyjson.com/products/category/${productInfo.value.category}`);
                    const data = await response.json();
                    
                    if (data && Array.isArray(data.products)) {
                      similarProducts.value = data.products.filter(product => product.id !== productInfo.value.id);
                      console.log("Filtered similar products:", similarProducts.value);
                    } else {
                        console.error("Invalid response format or no products found.");
                    }

                    console.log("Similar products:", similarProducts.value);
                    console.log("Raw similar products:", data.products);
                } catch (error) {
                    console.log("Fetching similar product", error);
                }
            };

            const selectSimilarProduct = (product, productId, productTitle) => {
              selectProduct(product);
              console.log("simi product checking", product);
              
              const visitedProduct = JSON.parse(localStorage.getItem('visitedProduct')) || [];
            
              const existProductInVisited = visitedProduct.find(item => item.productId === productId);

              if(!existProductInVisited){
                const currentDate = new Date().toISOString();

                const visitedProductInfo = {
                  productId : product.id,
                  visitCount : 1,
                  productTitle : product.title,
                  date : currentDate
                }
                visitedProduct.push(visitedProductInfo)
              }else{
                existProductInVisited.visitCount++;
              }

              localStorage.setItem('visitedProduct', JSON.stringify(visitedProduct));

              const totalVisitCount = visitedProduct.reduce((total, item) => total + item.visitCount, 0);

              localStorage.setItem('totalVisitCount', totalVisitCount);
              
              
            };

            const selectProduct = async (product) => {
                productInfo.value = product;
                productId.value = product.id;
                console.log("Selected product ID: ", productId.value);

                // Fetching the new product details and reviews
                await fetchProductDetails();
                loadReviewFirst();
            };

            const writeReview = () => {
                console.log("Calling write review");
                showReviewModal.value = true;
            };

            const setRating = (star) => {
                currentRating.value = star;
            };

            const loadReviewFirst = () => {
                const savedUserReviews = JSON.parse(localStorage.getItem('reviews_' + productId.value));
                console.log("saved user", savedUserReviews);
                
                if (savedUserReviews) {
                    userReviewList.value = savedUserReviews;
                } else {
                    userReviewList.value = [];
                }
            };
            const postReview = () => {
                if (username.value && comment.value && currentRating.value > 0) {
                    const userReview = {
                        username: username.value,
                        comment: comment.value,
                        rating: currentRating.value,
                        date: new Date(),
                    };

                    let productReview = JSON.parse(localStorage.getItem('reviews_' + productId.value)) || [];
                    productReview.push(userReview);

                    // Save the new review to localStorage
                    localStorage.setItem('reviews_' + productId.value, JSON.stringify(productReview));

                    userReviewList.value = productReview;

                    // Clear the form fields
                    // username.value = '';
                    // comment.value = '';
                    // currentRating.value = 0;

                    // Close the modal
                    showReviewModal.value = false;

                    // Optionally, you can alert here
                    // alert("Review posted successfully");
                } else {
                    // You can add alert or error handling here
                    // alert("Please fill all fields");
                }
            };

            return {
              totalWishlistProduct,
              visitedProduct,
                currentUsername,
                productInfo,
                totalCartItem,
                productId,
                showReviewModal,
                userReviewList,
                currentRating,
                username,
                comment,
                similarProducts,
                selectSimilarProduct,
                selectProduct,
                writeReview,
                setRating,
                loadReviewFirst,
                postReview,
                totalProductCount,
                totalWishListCount,
                totalDiscountPrice,
                discountPrice,
                signIn,
                createAccount,
                createNewUserAccount,
                loginUser,
                signOut,
                getProduct,
                searchInputProduct,
                selectSuggestion,
                increaseQuantity,
                decreaseQuantity,
                addToCart,
                showMyCart,
                showMyWishList,
                removeItem,
                handleItemRemoved,
                // cartIncreaseQuantity,
                // cartDecreaseQuantity,
                wishListIncreaseQuantity,
                wishListDecreaseQuantity,
                moveToCart,
                confirmMoveToCart,
                activeTab,
                setActiveTab,
                cartButtonText,
                placeholder,
                saveButtonText,
                saveToWishList,
                myWishListVisible,
                myCartVisible,
                childRef,
                updateWishList,
                totalVisitCount
                // calculateTotalDiscountPrice

            };





        }
    }
</script>



<style scoped>

.icon-hover:hover {
  border-color: #3b71ca;
  background-color: white;
  color: #3b71ca;
}

.icon-hover:hover i {
  color: #3b71ca !important;
}
.suggestion-list {
max-height: 200px;
overflow-y: auto;
border-radius: 0.25rem;
position: absolute;

}

.list-unstyled a{
  text-decoration:  none;
  
  color: #04a9f5;
}


.text-uppercase{

  color: #033143;
}
.sticky-header{
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 10; 
  background-color: white;
  width: 100%;
}



  button.checkout{
    border: none;
    background-color: #04a9f5 !important;
  } 


.cart-item {
  transition: background-color 0.2s ease;
}

.cart-item:hover {
  background-color: #f1f1f1;
}



.remove-item button:hover {
  background-color: #dc3545;
}


 a.nav-link:hover{
  text-decoration: none;
 
}

.background-fade {
  background-color: rgba(36, 36, 36, 0.513); /* Semi-transparent */
  transition: background-color 0.3s ease;
}

.icon-hover:hover{
  color: #04a9f5 !important ;
}



.no-hover-background:hover {
  background-color: transparent !important;
}

.similar-product:hover{
  cursor: pointer !important;
  background-color:#f1f1f1 !important;
}



.fa-star.filled {
  color: #ffc107;
}
</style>