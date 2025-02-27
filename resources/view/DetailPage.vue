<template>
    <div id="productDetails">
        <header class="sticky-header">
            <!-- Jumbotron -->
            <div class="p-3 text-center bg-white border-bottom" :class="{'background-fade': myCartVisible}">
              <div class="container ">
                <div class="row gy-3 align-items-center">
                  <!-- Left elements -->
                  <div class="col-lg-2 col-sm-4 col-4 d-flex justify-content-center align-items-center">
                    <img src="/assets/image/logo-colored.svg" alt="Bizvibe-logo" class="img-fluid" style="max-width: 150px; height: auto;">
                  </div>
                  <!-- Left elements -->
                  <div class="col-lg-4 col-md-12 col-12 position-relative">
                    <div class="input-group mx-auto" style="max-width: 500px; margin-right: 50px;">
                      <div class="form-outline">
                        <input type="search" id="form1" class="form-control" @input="searchInputProduct" v-model="enteredProductTitle" placeholder="Search"/>
                        <!-- <label class="form-label" for="form1">Search</label> -->
                      </div>
                      <button  @click="getProduct" type="button" class="btn btn-secondary" style="background-color: #033143;">
                        <i class="fa fa-search color-white"></i>
                      </button>
                    </div>

                    <div class="suggestion-list  rounded mb-50 d-flex justify-content-center">
                      <ul class="list-group text-start" style="overflow-y:auto">
                        <li v-for="suggestion in InputSuggestionProduct" :key="suggestion.id" @click="selectSuggestion(suggestion)" 
                        class="list-group-item list-group-item-action "  style="width: 250px;">
                          {{ suggestion.title }}
                        </li>
                      </ul>
                    </div>
                    
                  </div>
                  
          
                  <!-- Center elements -->
                  <div class="order-lg-last col-lg-6 col-sm-8 col-8 d-flex justify-content-end">
                    <div class="d-flex align-items-center">
                      <div class="d-flex justify-content-center align-items-center" style="margin-right: 10px; ">
                        <i class="fa fa-user" style="font-size:20px; margin-right: 3px;"></i>
                        <p style="margin-top: 15px;"><strong>{{currentusername}}</strong></p>
                      </div>

                      <button v-if="!isLoggedIn" @click="signIn" type="button" class="btn btn-primary position-relative border rounded py-1 px-3 d-none d-md-block mb-0" style="background-color: white; color: #033143; margin-right: 15px;"><i class="fa fa-user-alt m-1 me-md-2" style="color: #033143; cursor: pointer;"></i>
                        Sign in
                      </button>

                      <button v-if="isLoggedIn" @click="signOut" type="button" class="btn btn-primary position-relative border rounded py-1 px-3 d-none d-md-block mb-0"  style="background-color: white; color: #033143; margin-right: 15px;"><i class="fa fa-user m-1 me-md-2" style="color: #033143; cursor: pointer; font-size: 1.2rem;"></i>
                        Sign Out
                      </button>

                      <!-- sign in modal -->

                      <div v-show="showSignLoginModal" :class="{'background-fade': showSignLoginModal}" class="modal fade show" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block;">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <!-- <h3 class="modal-title fs-5" id="exampleModalLabel">Already an account ? <span>Login</span></h3> -->
                              <button type="button" class="btn-close" @click="showSignLoginModal = false" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form>
                                <div class="mb-2">
                                  <div class="d-flex justify-content-between">
                                    <label for="recipient-name" class="col-form-label">Email</label>
                                    <div></div>
                                  </div>
                                  <input v-model="enteredEmail" type="text" class="form-control" id="recipient-name">
                                </div>
                                <div class="mb-2">
                                  <div class="d-flex justify-content-between">
                                    <label for="message-text" class="col-form-label">Password</label>
                                    <div></div>
                                  </div>
                                  <input v-model="enteredPassword" type="text" class="form-control" id="recipient-name">
                                </div>
                                <div class="d-flex justify-content-between">
                                  <div></div>
                                  <button @click="loginUser" type="button" class="btn btn-secondary mt-2" data-bs-dismiss="modal">Login</button>
                                  <div></div>
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer d-flex justify-content-center align-items-center">
                              <p class="modal-title fs-5" id="exampleModalLabel">new user?</p>
                              <!-- <button @click="createAccount" type="button" class="btn btn-primary" style="background-color: #04a9f5; color: white; border: none;">Create Account</button> -->
                               <a @click="createAccount" href="#" style="color: #04a9f5;">Create account</a>
                            </div>
                          </div>
                        </div>
                      </div>


                      <!-- crate account modal -->

                      <div v-show="showCreateAccountModal" class="modal fade show" :class="{'background-fade' : showCreateAccountModal}" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block;">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Create your account</h1>
                                <button type="button" class="btn-close" @click="showCreateAccountModal = false" data-bs-dismiss="modal" aria-label="Close"></button>
                             
                            </div>
                            <div class="modal-body">
                              <form>
                                <div class="mb-2">
                                  <div class="d-flex justify-content-between">
                                    <label for="recipient-name" class="col-form-label">Email</label>
                                    <div></div>
                                  </div>
                                  <input v-model="enteredEmail" type="text" class="form-control" id="recipient-name">
                                </div>
                                <div class="mb-2">
                                  <div class="d-flex justify-content-between">
                                    <label for="message-text" class="col-form-label">Username</label>
                                    <div></div>
                                  </div>
                                  <input v-model="enteredUsername" type="text" class="form-control" id="recipient-name">
                                </div>
                                <div class="mb-2">
                                  <div class="d-flex justify-content-between">
                                    <label for="message-text" class="col-form-label">Password</label>
                                    <div></div>
                                  </div>
                                  
                                  <input v-model="enteredPassword" type="text" class="form-control" id="recipient-name">
                                </div>
                                <div class="mb-2">
                                  <div class="d-flex justify-content-between">
                                    <label for="message-text" class="col-form-label">Confirm Password</label>
                                    <div></div>
                                  </div>
                                  <input v-model="enteredConfirmPassword" type="text" class="form-control" id="recipient-name">
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer d-flex justify-content-center align-items-center">
                              <button @click="createNewUserAccount" type="button" class="btn btn-primary" style="background-color: #04a9f5; color: white; border: none;">create</button>
                            </div>
                          </div>
                        </div>
                      </div>






                      <button @click="showMyWishList"  type="button" class="btn btn-primary position-relative border rounded py-1 px-3 d-none d-md-block mb-0" style="background-color: white; color: #033143; margin-right: 15px;"><i class="fa fa-heart m-1 me-md-2" style="color: #033143; cursor: pointer;"></i>
                        Wishlist
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                          {{totalWishListCount}}
                        </span>
                      </button>


                      <button @click="showMyCart"  type="button" class="btn btn-primary position-relative border rounded py-1 px-3 d-none d-md-block mb-0" style="background-color: white; color: #033143;"><i class="fa fa-shopping-cart m-1 me-md-2" style="color: #033143; cursor: pointer;"></i>
                        My cart
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                          {{totalProductCount}}
                        </span>
                      </button>

                    </div>
                  </div>
                </div>
              </div>
              
            </div>
           
            <!-- Jumbotron -->
          
            <!-- Heading -->
            <div style="background-color: #033143;">

              
              <div class="container py-4">
                <!-- Breadcrumb -->
                <nav class="d-flex">
                  <h6 class="mb-0">
                    <a href="../../app_page/home_page/index.html" style="color: white;">Home</a>
                    <span class="text-white-50 mx-2"> > </span>
                    <a href="" class="text-white"><u>Product Details</u></a>
                  </h6>
                </nav>
                <!-- Breadcrumb -->
              </div>
            </div>
            <!-- Heading -->
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
          
          <div v-show="myCartVisible" :class="{'background-fade': myCartVisible}"  class="background-overlay modal fade show" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block;">
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
                <div class="modal-footer d-flex justify-content-between">
                  <div class="d-flex flex-column">
                    <h4>Total</h4>
                    <div class="d-flex">
                      <h5 style="margin-right: 8px; color: #28a745; font-size: 1.2rem; font-weight: 500;">Price : </h5>
                      <p style="margin-right: 8px; color: #28a745; font-size: 1rem; font-weight: 500;">${{totalDicountPrice.toFixed(2)}}</p>
                      <span class="text-danger">
                        <s>${{ totalPrice.toFixed(2)}}</s>
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
          <footer class="text-center text-lg-start text-muted  mt-3" style="background-color: rgb(244, 246, 250);">
            <!-- Section: Links  -->
            <section class="">
              <div class="container text-center text-md-start pt-4 pb-4">
                <!-- Grid row -->
                <div class="row mt-3">
                  <!-- Grid column -->
                  <div class="col-12 col-lg-3 col-sm-12 mb-2">
                    <!-- Content -->
                    <img src="/assests/logo-colored.svg" alt="">
                    <div style="margin-top: 15px;">
                      <p class="mt-1 text-dark">
                        &copy; 2025 copyright : Bizvibe.com
                       </p>
                    </div>
                      
                       
                    
                  </div>
                  <!-- Grid column -->
          
                  <!-- Grid column -->
                  <div class="col-6 col-sm-4 col-lg-2">
                    <!-- Links -->
                    <h6 class="text-uppercase  fw-bold mb-2">
                      Store
                    </h6>
                    <ul class="list-unstyled mb-4">
                      <li><a  href="#">About us</a></li>
                      <li><a  href="#">Find store</a></li>
                      <li><a  href="#">Categories</a></li>
                      <li><a  href="#">Blogs</a></li>
                    </ul>
                  </div>
                  <!-- Grid column -->
          
                  <!-- Grid column -->
                  <div class="col-6 col-sm-4 col-lg-2">
                    <!-- Links -->
                    <h6 class="text-uppercase  fw-bold mb-2">
                      Information
                    </h6>
                    <ul class="list-unstyled mb-4">
                      <li><a href="#">Help center</a></li>
                      <li><a href="#">Money refund</a></li>
                      <li><a href="#">Shipping info</a></li>
                      <li><a href="#">Refunds</a></li>
                    </ul>
                  </div>
                  <!-- Grid column -->
          
                  <!-- Grid column -->
                  <div class="col-6 col-sm-4 col-lg-2">
                    <!-- Links -->
                    <h6 class="text-uppercase  fw-bold mb-2">
                      Support
                    </h6>
                    <ul class="list-unstyled mb-4">
                      <li><a href="#">Help center</a></li>
                      <li><a  href="#">Documents</a></li>
                      <li><a  href="#">Account restore</a></li>
                      <li><a  href="#">My orders</a></li>
                    </ul>
                  </div>
                  <!-- Grid column -->
          
                  <!-- Grid column -->
                  <div class="col-12 col-sm-12 col-lg-3">
                    <!-- Links -->
                    <h6 class="text-uppercase  fw-bold mb-2">Newsletter</h6>
                    <p style="color: dimgray;">Stay in touch with latest updates about our products and offers</p>
                    <div class="input-group mb-3">
                      <input type="email" class="form-control border" placeholder="Email" aria-label="Email" aria-describedby="button-addon2" />
                      <button class="btn btn-light border shadow-0" type="button" id="button-addon2" data-mdb-ripple-color="dark">
                        Join
                      </button>
                    </div>
                  </div>
                  <!-- Grid column -->
                </div>
                <!-- Grid row -->
              </div>
            </section>
            <!-- Section: Links  -->
          
            <div class="">
              <div class="container">
                <div class="d-flex justify-content-between py-4 border-top">
                  <!--- payment --->
                  <div>
                    <i style="color: rgb(80, 187, 229);  padding: 7px;" class="fab fa-lg fa-cc-visa"></i>
                    <i style="color: rgb(80, 187, 229);  padding: 7px;" class="fab fa-lg fa-cc-amex"></i>
                    <i style="color: rgb(80, 187, 229); padding: 7px;" class="fab fa-lg fa-cc-mastercard"></i>
                    <i style="color: rgb(80, 187, 229);  padding: 7px;" class="fab fa-lg fa-cc-paypal"></i>
                  </div>
                  <!--- payment --->
          
                  <!--- language selector --->
                  <div class="dropdown dropup">
                    <a  style="color: #033143;" class="dropdown-toggle" href="#" id="Dropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false"> <i class="flag-united-kingdom flag m-0 me-1"></i>English </a>
          
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="Dropdown">
                      <li>
                        <a class="dropdown-item" href="#"><i class="flag-united-kingdom flag"></i>English <i class="fa fa-check text-secondary ms-2"></i></a>
                      </li>
                      <li><hr class="dropdown-divider" /></li>
                      <li>
                        <a class="dropdown-item" href="#"><i class="flag-poland flag"></i>Polski</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="#"><i class="flag-china flag"></i>中文</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="#"><i class="flag-japan flag"></i>日本語</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="#"><i class="flag-germany flag"></i>Deutsch</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="#"><i class="flag-france flag"></i>Français</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="#"><i class="flag-spain flag"></i>Español</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="#"><i class="flag-russia flag"></i>Русский</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="#"><i class="flag-portugal flag"></i>Português</a>
                      </li>
                    </ul>
                  </div>
                  <!--- language selector --->
                </div>
              </div>
            </div>
          </footer>
          <!-- Footer -->

    

    </div>
</template>

<script type="module">
    import { ref, computed, onMounted } from 'vue';

    export default{
        setup(){

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


            const totalPrice = computed(() => {
                return (cart.value && Array.isArray(cart.value)) 
                    ? cart.value.reduce((sum, item) => sum + item.price * item.quantity, 0)
                    : 0;
            });

            const totalDicountPrice = computed(() => {
                return (cart.value && Array.isArray(cart.value)) 
                    ? cart.value.reduce((discountSum, item) => discountSum + item.discountPrice * item.quantity, 0)
                    : 0;
            });

            const cartItemCount = computed(() => {
                return (cart.value && Array.isArray(cart.value)) 
                    ? cart.value.reduce((count, item) => count + item.quantity, 0)
                    : 0;
            });

            const totalProductCount = computed(() => {
                return cart.length;
            });

            const totalWishListCount = computed(() => {
                return wishList.length;
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
                saveToLocalStorage();
            };

            const decreaseQuantity = () => {
                if (placeholder.value >= 2) {
                    placeholder.value--;
                    cartButtonText.value = 'Updated Cart';
                    saveToLocalStorage();
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
              if (productInfo.value) {
                // Retrieve cart from localStorage or initialize it as an empty array
                let cart = JSON.parse(localStorage.getItem('cart')) || [];

                // Check if the product is already in the cart
                const existingProduct = cart.find(item => item.id === productInfo.value.id);

                if (!existingProduct) {
                  // If the product doesn't exist in the cart, add a new item
                  const cartItem = {
                    id: productInfo.value.id,
                    title: productInfo.value.title,
                    images: productInfo.value.images,
                    discountPrice: productInfo.value.discountPrice,
                    price: productInfo.value.price,
                    quantity: placeholder.value
                  };

                  // Add the new product to the cart
                  cart.push(cartItem);
                } else {
                  // If the product exists, update the quantity
                  existingProduct.quantity = placeholder.value;
                }

                // Save the updated cart to localStorage
                localStorage.setItem('cart', JSON.stringify(cart));

                // Update the button text
                checkProductInCartForAdded();
              }
            };


            const saveToWishList = () => {
              console.log("wishlist calling");

              if (productInfo.value) {
                // Retrieve wish list from localStorage or initialize it as an empty array
                const wishList = JSON.parse(localStorage.getItem('wishList')) || [];

                // Check if the product is already in the wish list
                const existingWishListProduct = wishList.find(item => item.id === productInfo.value.id);
                
                if (!existingWishListProduct) {
                  // If the product doesn't exist in the wish list, add a new item
                  const wishListItem = {
                    id: productInfo.value.id,
                    title: productInfo.value.title,
                    images: productInfo.value.images,
                    discountPrice: productInfo.value.discountPrice,
                    price: productInfo.value.price,
                    quantity: placeholder.value
                  };

                  // Add the new product to the wish list
                  wishList.push(wishListItem);
                  
                  // Save the updated wish list to localStorage
                  localStorage.setItem('wishList', JSON.stringify(wishList));
                  wishList.value = wishList;

                  // Update button states and other variables
                  isInWishList.value = true;
                  saveButtonText.value = "Saved";
                  checkProductInWishList(); // Assuming this function is available in your setup
                }
              }
            };




            const showMyCart = () => {
                console.log("my cart calling");
                myCartVisible.value = !myCartVisible.value;
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


            const removeItemFromWishList = (itemId) => {
                const updatedWishList = wishList.value.filter(item => item.id !== itemId);
                wishList.value = updatedWishList;
                isInWishList.value = false;
                localStorage.setItem('wishList', JSON.stringify(updatedWishList));
            };

            const cartIncreaseQuantity = (itemId) => {
                const item = cart.find(item => item.id === itemId);
                if (item) {
                    item.quantity++;
                    saveToLocalStorage();
                }
            };

            const cartDecreaseQuantity = (itemId) => {
                const item = cart.value.find(item => item.id === itemId);
                if (item && item.quantity > 1) {
                    item.quantity--;
                    saveToLocalStorage();
                }
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

            const selectSimilarProduct = (product) => {
                selectProduct(product);
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
                currentUsername,
                productInfo,
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
                totalPrice,
                totalDicountPrice,
                cartItemCount,
                totalProductCount,
                totalWishListCount,
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
                removeItemFromWishList,
                cartIncreaseQuantity,
                cartDecreaseQuantity,
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
                totalWishListCount,
                myWishListVisible,
                myCartVisible,
                

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
  /* color: rgb(80, 187, 229); */
  color: #04a9f5;
}


.text-uppercase{
  /* color: rgb(80, 187, 229); */
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

/* .gradient-custom {
  background: #6a11cb;
  
  background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
  
  background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
  } */

  button.checkout{
    border: none;
    background-color: #04a9f5 !important;
  } 



/* .modal-content {
  background-color: #fff;
  transition: transform 0.3s ease-out;
} */

/* .modal-content .btn-close {
  color: #007bff;
}  */

.cart-item {
  transition: background-color 0.2s ease;
}

.cart-item:hover {
  background-color: #f1f1f1;
}

/* .cart-item-quantity input {
  font-size: 1.1rem;
  padding: 5px;
} */

.remove-item button:hover {
  background-color: #dc3545;
}

/* .modal-footer button:hover {
  background-color: #0056b3;
  color: #fff;
} */
 a.nav-link:hover{
  text-decoration: none;
  /* color: white !important; */
  /* background-color: #04a9f5 !important; */
}

.background-fade {
  background-color: rgba(36, 36, 36, 0.513); /* Semi-transparent */
  transition: background-color 0.3s ease;
}

.icon-hover:hover{
  color: #04a9f5 !important ;
}

/* .info.similar-nav:hover{
  color: black !important;

  background-color: transparent !important;
} */

.no-hover-background:hover {
  background-color: transparent !important;
}

.similar-product:hover{
  cursor: pointer !important;
  background-color:#f1f1f1 !important;
}


/* write review (rating star), modal  */

.fa-star.filled {
  color: #ffc107;
}
</style>