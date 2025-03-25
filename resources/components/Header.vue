<template>
  
    <div>
        <header data-bs-theme="white">
        <div class="sticky-header navbar navbar-dark bg-white" style="margin-bottom: 50px;">
          <div class="container">
            <!-- <div class="sticky-header"> -->
              <a
              href="https://getbootstrap.com/docs/5.3/examples/album/#"
              class="navbar-brand d-flex align-items-center"
              >
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"  stroke="currentColor"  stroke-linecap="round"  stroke-linejoin="round"
                stroke-width="2"
                aria-hidden="true"
                class="me-2"
                viewBox="0 0 24 24"
              >
                <path
                  d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"
                ></path>
                <circle cx="12" cy="13" r="4"></circle>
              </svg>
              <div style="margin-top: 0px;">
                <!-- <img src="/assests/image/logo-colored.svg" alt=""> -->
                 <img src="http://localhost/Ecom-with-Compo_ESM/assets/image/logo-colored.svg" alt="">
              </div>
             
              

              </a>



                <div v-if="headerInputBoxPath" class="col-lg-4 col-md-12 col-12 position-relative">
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
            
            <div class="order-lg-last col-lg-6 col-sm-8 col-8 d-flex justify-content-end">
              <div class="d-flex align-items-center" style="margin-top: 8px;">
                <div class="d-flex justify-content-center align-items-center" style="margin-right: 10px; ">
                  <!-- <i class="fa fa-user" style="font-size:20px; margin-right: 3px;"></i> -->
                  <p style="margin-top: 15px;"><strong>Welcome {{currentUsername}}</strong></p>
                </div>

                <button v-if="!isLoggedIn" @click="signIn" type="button" class="btn btn-primary position-relative border rounded py-1 px-3 d-none d-md-block mb-0" style="background-color: white; color: #033143; margin-right: 15px;"><i class="fa fa-user m-1 me-md-2" style="color: #033143; cursor: pointer; font-size: 1.2rem;"></i>
                  Sign In
                </button>

                <button v-if="isLoggedIn" @click="signOut" type="button" class="btn btn-primary position-relative border rounded py-1 px-3 d-none d-md-block mb-0" style="background-color: white; color: #033143; margin-right: 15px;"><i class="fa fa-user m-1 me-md-2" style="color: #033143; cursor: pointer; font-size: 1.2rem;"></i>
                  Sign Out
                </button>

                <!-- sign login modal -->


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
                            <label for="recipient-name" class="col-form-label">Email</label>
                            <input v-model="enteredEmail" type="text" class="form-control" id="recipient-name">
                          </div>
                          <div class="mb-2">
                            <label for="message-text" class="col-form-label">Password</label>
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



                <!-- create account modal -->


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
                            <label for="email">Email</label>
                            <input type="email" id="email" v-model="enteredEmail" class="form-control">
                          </div>
                          <div class="mb-2">
                            <label for="username">Username</label>
                            <input type="text" id="username" v-model="enteredUsername" class="form-control">
                          </div>
                          <div class="mb-2">
                            <label for="password">Password</label>
                            <input type="password" id="password" v-model="enteredPassword" class="form-control">
                          </div>
                          <div class="mb-2">
                            <label for="confirmPassword">Confirm Password</label>
                            <input type="password" id="confirmPassword" v-model="enteredConfirmPassword" class="form-control">
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


                <button @click="showMyCart"  type="button" class="btn btn-primary position-relative border rounded py-1 px-3 d-none d-md-block mb-0" style="background-color: white; color: #033143;"><i class="fa fa-shopping-cart m-1 me-md-2" style="color: #033143; cursor: pointer; font-size: 1.2rem;"></i>
                  My cart
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{totalProductCount}}
                  </span>
                </button>
              </div>
            </div>
          <!-- </div> -->
            


            <!-- wish list modal copied from details.html  -->

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
  
                  <div v-show="showAlertModal" :class="{'background-fade': showAlertModal}" class="modal fade show" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block;">
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


            




            <div v-show="myCartVisible" :class="{'background-fade': myCartVisible}"  class="modal fade show" id="exampleModalToggle" tabindex="-1" aria-labelledby="exampleModalToggleLabel"  aria-hidden="true" style="display: block;">
              <div  class="modal-dialog modal-xl">
                <div  class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title fs-5" id="exampleModalToggleLabel" style="font-weight: bold; color: #333;">My Cart</h5>
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
                              <div class="d-flex justify-content-between align-items-center">
                                <div>
                                  <p><strong>Deliver to:</strong></p>
                                </div>
                                <button class="newAddressBtn btn btn-primary" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#exampleModalToggle2"
                                    @click="openSelectAddressPage">
                                    <!-- @click="openAddressPage" -->
                                    Change
                                </button>
                              </div>
                              <div class="checkAndAdd" v-if="selectedAddress">

                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                 {{ selectedAddress.flatName }}, {{ selectedAddress.street }}, {{ selectedAddress.landmark }}, {{ selectedAddress.city }}, {{ selectedAddress.state }}, {{ selectedAddress.pincode }}
                                </label>
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
                        <button type="button" class="checkout btn btn-primary" @click="proceedToCheckout">Proceed to Checkout</button>
                      </div>
                      <button type="button" class="btn btn-secondary" @click="myCartVisible = false" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div v-show="selectAddressPageVisible" :class="{'background-fade': selectAddressPageVisible}" class="modal fade show" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Select Address</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="selectAddressPageVisible = false"></button>
                  </div>
                  <div class="modal-body">
                     <h6 @click="openAddressPage" style="color: blue; cursor: pointer;"><span style="font-size: 20px;">+</span> Add New Address</h6>
                     <hr>
                      <div v-for="(eachAddress, index) in savedAddress" :key="index" class="d-flex">

                        <!-- <input class="form-check-input" type="radio" :name="'flexRadioDefault' + index" :id="'flexRadioDefault' + index" style="margin-right: 10px;"> -->
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"  :value="eachAddress" v-model="selectedAddress" style="margin-right: 10px;">

                        <label class="form-check-label" :for="'exampleRadios2' + index">
                          <div>{{ eachAddress.flatName }}, {{ eachAddress.street }}, {{ eachAddress.landmark }}, {{ eachAddress.city }}, {{ eachAddress.state }}, {{ eachAddress.pincode }} </div>
                         
                        </label>
                      </div>
                      
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="backToCart">Back</button>
                    <button type="button" class="btn btn-primary" @click="selectAddressToDeliver">Deliver here</button>
                  </div>
                </div>
              </div>
            </div>


            <!-- New Address Form -->
            <div v-show="addressPageVisible" :class="{'background-fade': addressPageVisible}"  class="modal fade show" id="model2" aria-hidden="true" aria-labelledby="model2" tabindex="-1" style="display: block;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="model2">Shipping Address</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="addressPageVisible = false"></button>
                  </div>
                  <div class="modal-body">
                    <form>
                      <div class="">
                        <label for="building-name" class="col-form-label" >Flat No/Building Name</label>
                        <input type="text" v-model="enteredFlatName" class="form-control" id="building-name">

                        <label for="street" class="col-form-label">Street/Road/Locality</label>
                        <input type="text" v-model="enteredStreet" class="form-control" id="street">

                        <label for="landmark" class="col-form-label">Landmark</label>
                        <input type="text" v-model="enteredLandmark" class="form-control" id="landmark">

                        <label for="city" class="col-form-label">City</label>
                        <input type="text" v-model="enteredCity" class="form-control" id="city">

                        <label for="state" class="col-form-label">State</label>
                        <input type="text" v-model="enteredState" class="form-control" id="state">

                        <label for="pincode" class="col-form-label">Pincode</label>
                        <input type="number" v-model="enteredPincode" class="form-control" id="pincode">

                       
                      </div>
                      
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="cancelAddressForm">Cancel</button>
                    <button type="button" class="btn btn-primary" @click="submitToSaveAddress">Submit</button>
                  </div>
                 
                </div>
              </div>
            </div>
           

          </div>
        </div>
      </header>
    </div>
</template>

<script type="module">
import {ref, reactive, computed, onMounted} from 'vue';
import { defineProps, defineEmits } from 'vue';
    export default {
      props: ['updateWishList'],
      props: ['updateCartList', 'myCartVisible'],
        setup(props){

          

          function closeCart(){
            this.$emit('updateCart', this.cart); 
          };

          const emit = defineEmits();
            const currentUsername = ref('guest');
            const totalWishlistProduct = ref(0)
            const headerInputBoxPath = ref(false);
            const addressPageVisible = ref(false);
            const selectAddressPageVisible = ref(false);
            // const currentUsername = ref([]);
            const savedAddress = ref([]);
            const enteredFlatName = ref("");
            const enteredStreet = ref("");
            const enteredLandmark = ref("");
            const enteredCity = ref("");
            const enteredState= ref("");
            const enteredPincode = ref("");
            const selectedAddress = ref(null);

            const enteredEmail = ref('');
            const enteredUsername = ref('');
            const enteredPassword = ref('');
            const enteredConfirmPassword = ref('');
            const totalCartItem = ref(0);
           
            const isLoggedIn = ref(false);
            
            const showSignLoginModal = ref(false);
            const showCreateAccountModal = ref(false);
            const enteredProductTitle = ref('');
            const ecommerceData = ref([]);
            const allProductData = ref([]);
            const filteredProducts = ref([]);
            const viewMode = ref('grid');
            const productCategory = ref([]);
            const selectedCategory = ref('');
            const sortOrder = ref('');
            const currentPage = ref(1);
            const productPerPage = ref(6);
            const totalPages = ref(0);
            const suggestionProduct = ref([]);
            const filtersApplied = ref(false);
            const debounceTimeout = ref(null);
            const abortController = ref(null);
            const wishListButtonText = ref('Add to wishlist');
            const showAlertModal = ref(false);
            const alreadyProductAlertModal = ref(false);

            const productInfo = ref(null);
            const productId = ref(null);
            const InputSuggestionProduct = ref([]);
            const placeholder = ref(1);
            const itemToMove = ref(null);
            const cart = ref(JSON.parse(localStorage.getItem('cart')) || []);
            const wishList = reactive([]);
            const saveButtonText = ref('Saved')
            const cartButtonText = ref('Add to cart');
            const myCartVisible = ref(false);
            const myWishListVisible = ref(false);
            const isInWishList = ref(false);
            const modalMessage = ref('');
            const similarProducts = ref([]);
            const activeTab = ref(1);
            const showReviewModal = ref(false);
            const currentRating = ref(0);
            const userReviewList = ref([]);


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
                return cart.value.length;
            });

            const totalWishListCount = computed(() => {
                return wishList.length;
            });



            onMounted(()=>{
                loadWishList();
                loadMyCart();
                checkLoginState();
                getUsernameFromStorage(); 
                // saveToWishList(); 
                checkPath();
                loadCartFromLocalStorage();
                const addresses = JSON.parse(localStorage.getItem('savedAddress')) || [];
                savedAddress.value = addresses;


                const savedSelectedAddress = JSON.parse(localStorage.getItem('selectedAddress'));
                selectedAddress.value = savedSelectedAddress
  
              
                
            });

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
              console.log('fetched product', productInfo.value);
            } catch (error) {
              console.log("Error fetching product details", error);
            }
          };
            function checkPath(){
                const currentPath = window.location.pathname;

                if(currentPath.includes('detail_page/index.html')){
                    headerInputBoxPath.value = true;
                }else{
                    headerInputBoxPath.value = false;
                }
            }

            const signIn = () => {
              showSignLoginModal.value = true;
            }

            const createAccount = () =>{
              showCreateAccountModal.value = true;
            }

            const createNewUserAccount = () => {
              if(enteredEmail.value && enteredUsername.value && enteredPassword.value && enteredConfirmPassword.value){
                  if(enteredPassword.value === enteredConfirmPassword.value){

                  
                      let userId = parseInt(localStorage.getItem('eachUserId')) || 0;
                      userId += 1;
                      localStorage.setItem('eachUserId', userId);

                      const  newUser = {
                        userId,
                        email: enteredEmail.value,
                        username: enteredUsername.value,
                        password: enteredPassword.value,
                          // confirmPassword : this.enteredConfirmPassword
                      };
                      const createdUser = JSON.parse(localStorage.getItem('newUser')) || [];

                      const userExist = createdUser.find(user => user.email === enteredEmail.value);
                      if(userExist){
                          alert("This email is already registered");
                          return;
                      }

                      createdUser.push(newUser);
                      alert("account created successfully");
                      localStorage.setItem('newUser', JSON.stringify(createdUser));

                      isLoggedIn.value = true;
                      currentUsername.value = enteredUsername.value; 
                      
                      
                      localStorage.setItem('currentUsername', currentUsername.value);

                     

                      showCreateAccountModal.value = false;
                      showSignLoginModal.value = false;

                  }else{
                      alert("password not matched")
                  }
              }else{
                  alert("fill all the field")
              }
              
            
            }
            
            const getUsernameFromStorage = () => {
              const storedUsername = localStorage.getItem('currentUsername');
              currentUsername.value = storedUsername ? storedUsername : 'guest';
            }
            
            const loginUser = () => {
            
              const email = enteredEmail.value;
              const password = enteredPassword.value;

              const createdUser = JSON.parse(localStorage.getItem('newUser')) || [];

              const user = createdUser.find(user => user.email === email);
              if(user){
                  if(user.password === password){
                    

                      localStorage.setItem('currentUsername', user.username);
                      currentUsername.value = user.username;
                      isLoggedIn.value = true;
                      showSignLoginModal.value = false;
                      alert("login successfully");
                  }else{
                      alert("incorrect password!")
                  }
              }else{
                  alert("user not found")
              }
            }
            const signOut = ()=> {
                currentUsername.value = '';
                isLoggedIn.value = false;
                localStorage.removeItem('currentUsername'); 
                alert("user logged out successfully")
            }

            const checkLoginState = () => {
                const storedUsername = localStorage.getItem('currentUsername');
                if (storedUsername) {
                    isLoggedIn.value = true;
                    currentUsername.value = storedUsername;
                } else {
                    isLoggedIn.value = false;
                    currentUsername.value = 'guest';
                }
            }



            const openAddressPage = () => {
              addressPageVisible.value = true;
              myCartVisible.value = false;
              selectAddressPageVisible.value = false;

            }

            const cancelAddressForm = () => {
              addressPageVisible.value = false;
              // myCartVisible.value = true;
              selectAddressPageVisible.value = true;

            }

            const openSelectAddressPage = () => {
              selectAddressPageVisible.value = true;
              myCartVisible.value = false;
            }
            const backToCart = () => {
              selectAddressPageVisible.value = false;
              myCartVisible.value = true;
            }


            const selectAddressToDeliver = () => {
              console.log("selected address", selectedAddress.value);
              if(selectedAddress.value){
                localStorage.setItem('selectedAddress', JSON.stringify(selectedAddress.value));
              }
              
              selectAddressPageVisible.value = false;
              myCartVisible.value = true;
            }

            const loadWishList = () => {
                const storedWishList = JSON.parse(localStorage.getItem('wishlist')) || [];
                wishList.value = storedWishList;
            };

            const proceedToCheckout = () => {
              console.log("checkou calling");
              console.log(selectedAddress.value);
              
              
              if(!isLoggedIn.value){
                alert("Please log in to proceed with the checkout.");
                return;
              }
              

              if(!selectedAddress.value){
                alert("Please select a delivery address.");
                return;

              }

              // if(cart.length.value === 0){
              //   alert("Product not in the cart, Please add product in the cart")
              //   return;
              // }
              
              let orderId = parseInt(localStorage.getItem('orderId')) || [];

              orderId += 1;
              const orderIdFormat = `ORD_${orderId}`;

              localStorage.setItem('orderId',  orderId.toString());

              const oderDetails = {
                orderId : orderIdFormat,
                userId: localStorage.getItem('eachUserId'),
                products: cart.value.map((item => ({
                  id: item.id,
                  quantity : item.quantity,
                  title: item.title
                }))),
                totalAmount : totalDicountPrice.value,
                address : selectedAddress.value,
                date : new Date().toISOString(),

              };

              let orderPlacedData = JSON.parse(localStorage.getItem('orderPlacedData')) || [];

              orderPlacedData.push(oderDetails);
             
              localStorage.setItem('orderPlacedData', JSON.stringify(orderPlacedData));

              localStorage.removeItem('cart');
              cart.value = [];

              alert(`Checkout successful! Your order ID is ${orderIdFormat}`);
            }



            const submitToSaveAddress = () =>{
              const address = {
                flatName : enteredFlatName.value,
                street : enteredStreet.value,
                landmark : enteredLandmark.value,
                city: enteredCity.value,
                state: enteredState.value,
                pincode : enteredPincode.value
              }
              let shippingAddress = JSON.parse(localStorage.getItem('savedAddress')) || [];
              shippingAddress.push(address);

              localStorage.setItem('savedAddress', JSON.stringify(shippingAddress))
              savedAddress.value = shippingAddress;

              alert("Address saved successfully")

              enteredFlatName.value = '';
              enteredStreet.value = '';
              enteredLandmark.value = '';
              enteredCity.value = '';
              enteredState.value = '';
              enteredPincode.value = '';
            }


            const loadMyCart = () => {
              const storedMyCart = JSON.parse(localStorage.getItem('cart')) || [];
              cart.value = storedMyCart;
            }

            const removeItem = (itemId) => {
                const updatedCart = cart.value.filter(item => item.id !== itemId);
                cartButtonText.value = 'Add to cart';
                cart.value = updatedCart;

                localStorage.setItem('cart', JSON.stringify(updatedCart));

            };

            // const addToCart = () => {
            //   totalCartItem.value++;
            //   console.log("cart calling");
              
            //   if (productInfo.value) {
            //     let cart = JSON.parse(localStorage.getItem('cart')) || [];

            //     const existingProduct = cart.find(item => item.id === productInfo.value.id);

            //     if (!existingProduct) {
            //       const discountPrice = (productInfo.value.price - (productInfo.value.price * productInfo.value.discountPercentage / 100)).toFixed(2);
            //       const cartItem = {
            //         id: productInfo.value.id,
            //         title: productInfo.value.title,
            //         images: productInfo.value.images,
            //         discountPrice: discountPrice,
            //         price: productInfo.value.price,
            //         quantity: placeholder.value
            //       };

            //       cart.push(cartItem);
            //       console.log("discount price", productInfo.value.discountPrice);
            //       console.log("image", productInfo.value.images);
                  
            //       localStorage.setItem('cart', JSON.stringify(cart));
            //       cart.value = cart;
                  

            //     } else {
            //       existingProduct.quantity = placeholder.value;
            //     }

            //     // calculateTotalDiscountPrice(cart);
                

            //     checkProductInCartForAdded();
            //   }
            // };

            const cartIncreaseQuantity = (itemId) => {
                const item = cart.value.find(item => item.id === itemId);
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
            const saveToLocalStorage = () => {
                localStorage.setItem('cart', JSON.stringify(cart.value));
                localStorage.setItem('wishList', JSON.stringify(wishList.value));
            };



            const showMyCart = () => {
              console.log("show my cart");
            
              myCartVisible.value = !myCartVisible.value;

              // const modalCart = new bootstrap.Modal(document.getElementById('exampleModalToggle'));
              // if (myCartVisible.value) {
              //     modalCart.show();
              // } else {
              //     modalCart.hide();
              // }
            };

            const showMyWishList = () => {
                myWishListVisible.value = !myWishListVisible.value;

            };
            const wishListDecreaseQuantity = (itemId) => {
                const item = wishList.value.find(item => item.id === itemId);
                if (item && item.quantity > 1) {
                    item.quantity--;
                    localStorage.setItem('wishlist', JSON.stringify(wishList.value));
                }
            };

            const wishListIncreaseQuantity = (itemId) => {
                const item = wishList.value.find(item => item.id === itemId);
                if (item) {
                    item.quantity++;
                    localStorage.setItem('wishlist', JSON.stringify(wishList.value));
                }
            };
           
            // const wishlistButtonText = ref('Save');

            const removeItemFromWishList = (itemId) => {
              let storedWishList = JSON.parse(localStorage.getItem('wishList')) || [];
                const updatedWishList = storedWishList.filter(item => item.id !== itemId);
                localStorage.setItem('wishList', JSON.stringify(updatedWishList));
                wishList.length = 0;
                wishList.push(...updatedWishList); 
                isInWishList.value = false;
                saveButtonText.value = 'save'

                props.updateWishList(updatedWishList);
                
            };


            


           

            // Calculate total discount price
            const calculateTotalDiscountPrice = (cart) => {
              totalDicountPrice.value = cart.reduce(
                (acc, item) => acc + (item.discountPrice * item.quantity),
                0
              );
            };


            const moveToCart = (item) => {
              console.log("move to cart calling");
              
                // removeItemFromWishList(item.id); 
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                let wishList = JSON.parse(localStorage.getItem('wishList')) || [];

                const existingProductInCart = cart.find(cartItem => cartItem.id === item.id);
                if(existingProductInCart){
                    showAlertModal.value = true;
                    modalMessage.value = "This product is already in the cart, Do you want to update it"

                    itemToMove.value = item;
                  
                }else{
                    cart.push(item);
                    wishList = wishList.filter(wishListItem => wishListItem.id !== item.id);
                    isInWishList.value = false;
                    cartButtonText.value = "Added";


                    localStorage.setItem('cart', JSON.stringify(cart));
                    localStorage.setItem('wishList', JSON.stringify(wishList));

                    cart.value = cart;
                    wishList.value = wishList;

                    
                }  
            };

            const confirmMoveToCart =  () => {

              const cart = JSON.parse(localStorage.getItem('cart')) || [];
              let wishList = JSON.parse(localStorage.getItem('wishList')) || [];

              const item = itemToMove.value;  
              console.log("s", item);

              const existingProductInCart = cart.find(cartItem => cartItem.id === item.id);

              if (existingProductInCart) {

                  existingProductInCart.quantity = item.quantity;
                  wishList = wishList.filter(wishListItem => wishListItem.id !== item.id);

                  localStorage.setItem('cart', JSON.stringify(cart));
                  localStorage.setItem('wishList', JSON.stringify(wishList));

                  cart.value = cart;
                  wishList.value = wishList;

                  isInWishList.value = false;
                  cartButtonText.value = "Added";

                  showAlertModal.value = false;

              } else {
                  showAlertModal.value = false;
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
            
            const loadCartFromLocalStorage = () => {
                const cartData = JSON.parse(localStorage.getItem('cart')) || [];

                console.log("Loaded cart data:", cartData);

                cart.value = cartData; 

                const wishListData = JSON.parse(localStorage.getItem('wishList')) || [];

                if (wishListData.length > 0) {
                    wishList.splice(0, wishList.length, ...wishListData);

                    console.log("wishlistData:", wishList.value);
                } else {
                    console.log("No Data to display for wishlist!");
                }
            };

    


            return{
              signIn, proceedToCheckout, getUsernameFromStorage, loginUser, signOut, isLoggedIn, checkLoginState, currentUsername, createAccount, showCreateAccountModal,  enteredEmail, enteredUsername, enteredPassword, enteredConfirmPassword, showSignLoginModal, createNewUserAccount, saveButtonText, showAlertModal, modalMessage, isInWishList, wishList, calculateTotalDiscountPrice, props, totalWishListCount, totalWishlistProduct, wishList, headerInputBoxPath, showMyCart, showMyWishList, myWishListVisible, totalProductCount, totalPrice, totalDicountPrice, cartItemCount,
              submitToSaveAddress,selectAddressToDeliver, selectedAddress,  savedAddress, enteredFlatName, enteredPincode, enteredState, enteredCity, enteredStreet, enteredLandmark, myCartVisible, openAddressPage, addressPageVisible, cancelAddressForm, selectAddressPageVisible, openSelectAddressPage, backToCart,  confirmMoveToCart,  cart, closeCart, cartIncreaseQuantity, cartDecreaseQuantity, removeItemFromWishList, removeItem, loadCartFromLocalStorage, fetchProductDetails, wishListDecreaseQuantity,  wishListIncreaseQuantity, moveToCart
            }
        }
    }
</script>

<style scoped>


.sticky-header{
  position: fixed !important;
  top: 0 !important;
  left: 0 !important;
  right: 0 !important;
  z-index: 10 !important; 
  background-color: rgb(255, 253, 253) !important;
  width: 100% !important;
}

.background-fade {
  background-color: rgba(65, 65, 65, 0.513); 
  transition: background-color 0.3s ease;
}

.form-check{
  width: 500px;
  border: 1px solid rgb(241, 241, 241);
  margin-left: 20px;
  word-wrap: none;
  padding: 10px;
}
.checkAndAdd{
  margin-left: 20px;
}
.newAddressBtn{
  border: 1px solid rgb(223, 218, 218) !important;
  background-color: white !important;
  color: #0d6efd !important;
  font-size: 14px !important;
  font-weight: 500;
  padding: 4px 10px !important;
}
</style>