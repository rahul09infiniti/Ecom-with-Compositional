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
                 <img src="/assets/image/logo-colored.svg" alt="">
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
                  <i class="fa fa-user" style="font-size:20px; margin-right: 3px;"></i>
                  <p style="margin-top: 15px;"><strong>{{currentusername}}</strong></p>
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
                            <label for="recipient-name" class="col-form-label">Email</label>
                            <input v-model="enteredEmail" type="text" class="form-control" id="recipient-name">
                          </div>
                          <div class="mb-2">
                            <label for="message-text" class="col-form-label">Username</label>
                            <input v-model="enteredUsername" type="text" class="form-control" id="recipient-name">
                          </div>
                          <div class="mb-2">
                            <label for="message-text" class="col-form-label">Password</label>
                            <input v-model="enteredPassword" type="text" class="form-control" id="recipient-name">
                          </div>
                          <div class="mb-2">
                            <label for="message-text" class="col-form-label">Confirm Password</label>
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
  
                          <div><p v-if="item.discountPrice" style="margin-right: 10px; color: #28a745; font-size: 1rem; font-weight: 500;"> Price : {{((item.discountPrice) *  (item.quantity))}}</p></div>
                          <div>
                            <span class="text-danger" style="font-size: 1rem;"> 
                              <s> {{ ((item.price)* (item.quantity)) }}</s>
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
      props: ['cart', 'myCartVisible'],
        setup(props){

          

          function closeCart(){
            this.$emit('updateCart', this.cart); // Optionally pass updated cart back to parent
          };
          const emit = defineEmits();

          const totalWishlistProduct = ref(0)
            const headerInputBoxPath = ref(false);
            // const totalWishListCount = ref(0);
            const enteredEmail = ref('');
            const enteredUsername = ref('');
            const enteredPassword = ref('');
            const enteredConfirmPassword = ref('');
            
            
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
            const cart = reactive([]);
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
                return cart.length;
            });

            const totalWishListCount = computed(() => {
                return wishList.length;
            });



            onMounted(()=>{
                loadWishList();
                // saveToWishList(); 
                checkPath();
                loadCartFromLocalStorage();
                
                
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

            const loadWishList = () => {
                const storedWishList = JSON.parse(localStorage.getItem('wishlist')) || [];
                wishList.value = storedWishList;
            };
           
            // const saveToWishList = (product) => {
            //     if (!product || !product.price || !product.title || !product.id) {
            //         console.error("Invalid product object:", product);
            //         return;
            //     }

            //     if (isNaN(product.price) || (product.discountPercentage && isNaN(product.discountPercentage))) {
            //         alert("Invalid price or discount percentage");
            //         return;
            //     }

            //     const discountPrice = product.discountPercentage
            //         ? (product.price - (product.price * product.discountPercentage / 100)).toFixed(2)
            //         : product.price.toFixed(2);

            //     const discountPriceNum = parseFloat(discountPrice); 

            //     const productToAdd = {
            //         id: product.id,
            //         title: product.title,
            //         price: product.price,
            //         discountPrice: discountPriceNum,
            //         quantity: 1,  
            //         images: product.images,
            //     };

            //     const existingProduct = wishList.value.find(item => item.id === productToAdd.id);
            //     if (!existingProduct) {
            //         wishList.value.push(productToAdd);
            //         localStorage.setItem('wishlist', JSON.stringify(wishList.value));
            //     }
            // };


           


            const showMyCart = () => {
                myCartVisible.value = !myCartVisible.value;
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

            // defineExpose({
            //     removeItemFromWishList
            // });
                
            const moveToCart = (item) => {
                removeItemFromWishList(item.id); 
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
                    // wishList.value = wishListData;  
                    wishList.splice(0, wishList.length, ...wishListData);

                    console.log("wishlistData:", wishList.value);
                } else {
                    console.log("No Data to display for wishlist!");
                }
            };

    


            return{
              saveButtonText, props, totalWishListCount, totalWishlistProduct, wishList, totalWishListCount, headerInputBoxPath, showMyCart, showMyWishList, myWishListVisible, totalProductCount, totalPrice, totalDicountPrice, cartItemCount,
                myCartVisible, closeCart, removeItemFromWishList,loadCartFromLocalStorage, fetchProductDetails, wishListDecreaseQuantity,  wishListIncreaseQuantity, moveToCart
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
  background-color: white !important;
  width: 100% !important;
}

.background-fade {
  background-color: rgba(65, 65, 65, 0.513); /* Semi-transparent */
  transition: background-color 0.3s ease;
}
</style>