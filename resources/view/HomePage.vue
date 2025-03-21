<template>
    <div id="ecommerce">
      <!-- Header -->

      <page-header :key="totalWishlistProduct"></page-header>

      <!-- <div v-show="myWishListVisible" :class="{'background-fade': myWishListVisible}"  class="background-overlay modal fade show" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block;">
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
  
                          <div><p v-if="item.discountPrice" style="margin-right: 10px; color: #28a745; font-size: 1rem; font-weight: 500;"> Price : ${{((item.discountPrice) *  (item.quantity))}}</p></div>
                          <div>
                            <span class="text-danger" style="font-size: 1rem;"> 
                              <s> ${{ ((item.price)* (item.quantity)) }}</s>
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
  
      </div> -->
      <main>



        <section class="py-5 text-center container">
          <div class="row py-lg-5 m-0" style="height: 130px">
            <div class="col-lg-6 col-md-8 mx-auto">
              <h1 class="fw-light" style="color: #033143;">Products</h1>
              <p class="lead text-body-secondary">Search for a Product</p>

              <!-- SearchBox -->
              <div class="searchBox">
                <i class="fa fa-search"></i>
                <input
                  type="text"
                  placeholder="Search Products...."
                  v-model="enteredProductTitle" @input="searchInput" class="form-control"
                  />
                  
                <button class="search-btn" @click="getProduct">Search</button> 
                              
              </div>
              <div class="suggestion-list  rounded mb-50 d-flex justify-content-center" style="height: 110px;">
                <ul class="list-group text-start">
                  <li v-for="suggestion in suggestionProduct" :key="suggestion.id" @click="selectSuggestion(suggestion)" 
                  class="list-group-item list-group-item-action "  style="width: 450px;">
                    {{ suggestion.title }}
                  </li>
                </ul>
              </div>
            </div>
          
          </div>
         

        </section>

 
          <div id="ecommerce" class="container py-5" style="margin-top: 20px">

            <div class="d-flex justify-content-end" style="margin-bottom: 20px;">
              <button @click="viewMode = 'grid'" :class="{'btn-primary':viewMode === 'grid', 'btn-outline-secondary' : viewMode !== 'grid'}" class="btn me-3">Grid</button>
              <button @click="viewMode = 'list'" :class="{'btn-primary' : viewMode === 'list', 'btn-outline-secondary': viewMode !== 'list'}" class="btn" style="margin-right: 10px;">List</button>
              <button v-if="filtersApplied" @click="clearFilters" type="button" class="btn btn-outline-secondary">Clear</button>


            </div>

            <div class="d-flex justify-content-between">
              

              <select @change="filterByCategory(selectedCategory)" v-model="selectedCategory" class="form-select" aria-label="Default select example" style="margin-bottom: 20px; width: 220px; margin-right: 10px;">

                <option value="" disabled >Select Category</option>
                <option v-for="category in productCategory" :key="category.id" :value="category">{{ category }}</option>

               </select>
               

              <select @change="sortProduct"  v-model="sortOrder" name="" id="" class="form-select" aria-label="Default select example" style="width: 220px; margin-bottom: 20px;" >
                <option value="">Select by title</option>
                <option value="ascending">Ascending order</option>
                <option value="descending">Descending order </option>
              </select> 
            </div>

            
            <div class="row justify-content-center mb-10"
            > 
              <div 
                class="product-card"
                v-for="product in filteredProducts"
                :key="product.id"
                :class="viewMode === 'grid' ? 'col-md-4 mb-4' : 'col-12 col-md-10 mb-4'"
                :style="viewMode === 'list' ? { width: '90%', height: 'auto', minHeight: '200px' } : {}"
              >
                <div class="card shadow-0 border rounded-3 h-100">
                  <div class="card-body">

                    <!-- change nothing to  d-flex align-items-center  -->
                    <div class="row  d-flex align-items-center">

                      <!-- Product Image -->
                      <div :class="viewMode === 'grid' ? 'col-12 col-md-4' : 'col-12 col-md-4'">
                        <div class="bg-image hover-zoom ripple rounded ripple-surface">
                          <img :src="product.images[0]" class="w-100" alt="Product Image" 
                          :style="viewMode === 'list' ? {objectFit : 'cover'} : {}" />
                          <a href="#!">
                            <div class="hover-overlay">
                              <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                            </div>
                          </a>
                        </div>
                      </div>
        
                      <!-- Product Details (Moved to the right of the image in list view) -->
                      <div :class="viewMode === 'grid' ? 'col-12 col-md-8' : 'col-12 col-md-4'" >

                            <h5 class="mb-0">{{ product.title }}</h5>
                            
                            <p class="mb-0"><strong>Brand:</strong> {{ product.brand }}</p>  
                            <p class="mb-1"><strong>category :</strong> {{product.category}}</p>
        
                        <!-- Rating and Reviews -->
                        <div class="d-flex flex-row">
                          <div class="text-danger mb-1 me-2">
                            <span v-for="num in Math.floor(product.rating)">
                              <i class="fa fa-star"></i>
                            </span>
                            <span v-if="product.rating > Math.floor(product.rating)">
                              <i class="fa fa-star-half-full"></i>
                            </span>
                          </div>
                          <span>{{ product.rating }} Rating</span>
                        </div>
        
                        <p class="mt-2">{{ product.description }}</p>
                        </div>
                    

                       <!-- Pricing, Return Policy, and Actions (Always at bottom for grid view) -->
                        <div :class="viewMode === 'grid' ? 'col-12' : 'col-12 col-md-4'">
                          <div class="d-flex  justify-content-between  mt-3">
                            <div></div>
                          <!-- Pricing and Return Policy Section -->
                            <div class="flex-grow-1">
                              <div class="d-flex flex-column align-items-start">
                                <div class="d-flex flex-row align-items-center mb-1">
                                  <h4 class="mb-1 me-1">
                                  {{ discountPrice= (product.price - (product.price * product.discountPercentage / 100)).toFixed(2) }}
                                  </h4>
                                  <span class="text-danger">
                                  <s>{{ product.price }}</s>
                                  </span>
                                </div>
                                <strong>Discount - {{ product.discountPercentage }}%</strong>
                                <h6 class="text-success">{{ product.shippingInformation }}</h6>
                                <h6 class="text-muted">{{ product.returnPolicy }}</h6>
                              </div>
                            </div>
            
                          <!-- Actions Section (Buttons to the right) -->
    
                            <div class="d-flex flex-column mt-4">
                              <button @click="goToProductDetails(product.id, product.title)" class="btn btn-primary btn-sm" type="button" style="background-color: #04a9f5; border: none;">Details</button>
                              <button @click="saveToWishList(product)" class="wishlist-btn btn btn-outline-primary btn-sm mt-2" type="button">{{wishListButtonText}}</button>
                            </div>

                            <!-- wishlist alert modal -->
                            <div v-show="showAlertModal"  :class="{'addToWishlistBackground-fade': showAlertModal}" class=" background-overlay modal fade show" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block;">
                              <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" @click="showAlertModal = false" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <p><strong>Product Added in the WishList</strong></p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="ok-btn btn btn-primary" @click="showAlertModal = false">Ok</button>
                                  </div>
                                </div>
                              </div>
                            </div>



                            <div v-show="alreadyProductAlertModal"  :class="{'addToWishlistBackground-fade': alreadyProductAlertModal}" class=" background-overlay modal fade show" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block;">
                              <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" @click="alreadyProductAlertModal = false" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <p><strong>Product is already in the Wishlist</strong></p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="ok-btn btn btn-primary" @click="alreadyProductAlertModal = false">Ok</button>
                                  </div>
                                </div>
                              </div>
                            </div>


                        
                          </div>
                        </div>
 
                    </div>
 
                  </div>
                </div>
              </div>

              <nav aria-label="Page navigation example d-flex">
                <ul class="pagination justify-content-center">
                  <li class="page-item ">
                    <a style="color: #04a9f5;" class="page-link" @click.prevent ="previousPage" :disabled ="currentPage === previousPage" href="#">Previous</a>
                  </li>
      
                  <li class="page-item" v-for="page in totalPages" @click.prevent='gotoPage(page)'>
                    <a style="color: #04a9f5;" class="page-link" href="#">{{page}}</a>
                  </li>
      
                  <li class="page-item">
                    <a style="color: #04a9f5;" class="page-link" @click.prevent="nextPage" :disabled ="currentPage === totalPages" href="#">next</a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>

        
        
      </main>

      <page-footer></page-footer>
    </div>
</template>

<script type="module">
import Header from '../components/Header.vue'
import Footer from '../components/Footer.vue'
    import { ref, reactive, computed, onMounted } from 'vue';

    export default{
      components:{
        'page-header' : Header,
        'page-footer' : Footer

      },
      setup() {
        const totalVisitCount = ref([]);
        const visitCount = ref(0);
        const totalWishlistProduct = ref(0);
          const enteredEmail = ref('');
          const enteredUsername = ref('');
          const enteredPassword = ref('');
          const enteredConfirmPassword = ref('');
          
          const isLoggedIn = ref(false);
          
          const showSignLoginModal = ref(false);
          const showCreateAccountModal = ref(false);
          const enteredProductTitle = ref('');
          const visitedProduct = ref([]);
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
          const cartButtonText = ref('Add to cart');
          const saveButtonText = ref('Save');
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
            return cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
          });
          
          const totalDicountPrice = computed(() => {
            return cart.reduce((discountSum, item) => discountSum + item.discountPrice * item.quantity, 0);
          });
          
          const cartItemCount = computed(() => {
            return cart.reduce((count, item) => count + item.quantity, 0);
          });

          const totalProductCount = computed(() => {
            return cart.length;
          });

          // const totalWishListCount = computed(() => {
          //   return wishList.length;
          // });



              // Lifecycle hooks
          onMounted(() => {
            allProducts();
            console.log("total price", totalPrice);
            
            getCategory();
            checkLoginState();
            // getUsernameFromStorage();
            const urlParams = new URLSearchParams(window.location.search);
            productId.value = urlParams.get('id');
            console.log('Product ID from URL:', productId.value);

            fetchProductDetails();
            loadCartFromLocalStorage();
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
              alert("fill all the fields");
            }
          };

          const getUsernameFromStorage = () => {
            const storedUsername = localStorage.getItem('currentUsername');
            return storedUsername ? storedUsername : 'guest';
          };

          const currentUsername = ref(getUsernameFromStorage());

          const loginUser = () => {
            const enteredEmailVal = enteredEmail.value;
            const enteredPasswordVal = enteredPassword.value;
            const createdUser = JSON.parse(localStorage.getItem('newUser')) || [];
            const user = createdUser.find(user => user.email === enteredEmailVal);
            if (user) {
              if (user.password === enteredPasswordVal) {
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
            currentUsername.value = '';
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

          async function allProducts() {
                try {
                    const response = await fetch('https://dummyjson.com/products');
                    const data = await response.json();
                    ecommerceData.value = data.products;
                    allProductData.value = [...ecommerceData.value];
                    totalPages.value = Math.ceil(ecommerceData.value.length / productPerPage.value);
                    paginateProducts(); // Assuming this function is defined elsewhere
                    checkProductInWishList(); // Assuming this function is defined elsewhere
                } catch (error) {
                    console.log('Fetching data error:', error);
                }
          }


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


          const increaseQuantity = () => {
            placeholder.value++;
            cartButtonText.value = 'Updated Cart';
            saveToLocalStorage();
          };

          const decreaseQuantity = () => {
            if (placeholder.value >= 2) placeholder.value--;
            cartButtonText.value = 'Updated Cart';
            saveToLocalStorage();
          };

          const loadCartFromLocalStorage = () => {
            const cartData = JSON.parse(localStorage.getItem('cart')) || [];
            console.log("Loaded cart data:", cartData);
            // if (cartData) cart.splice(0, cart.length, ...cartData);
            if(cartData){
              cart.value = cartData;
            }

            const wishListData = JSON.parse(localStorage.getItem('wishList')) || [];
            if (wishListData.length > 0) {
              // wishList.splice(0, wishList.length, ...wishListData);
              wishList.value = wishListData;
              console.log("wishlistData", wishList);
            } else {
              console.log("No Data to display!!!!!");
            }
          };

          const showMyCart = () => {
            console.log("my cart calling");
            myCartVisible.value = !myCartVisible.value;
          };

          const showMyWishList = () => {
            console.log("show my wishlist calling");
            myWishListVisible.value = !myWishListVisible.value;
          };

          // const addToCart = () => {
          //   if (productInfo.value) {
          //     let cart = JSON.parse(localStorage.getItem('cart')) || [];

          //     const existingProduct = cart.find(item => item.id === productInfo.value.id);

          //     if (!existingProduct) {
          //       const cartItem = {
          //         id: productInfo.value.id,
          //         title: productInfo.value.title,
          //         images: productInfo.value.images,
          //         discountPrice: productInfo.value.discountPrice,
          //         price: productInfo.value.price,
          //         quantity: placeholder.value,
          //       };

          //       cart.push(cartItem);
          //       cart.value = cart;
          //       saveToLocalStorage();
          //       checkProductInCartForAdded();
          //     } else {
          //       existingProduct.quantity = placeholder.value;
          //       cart.value = cart;
          //       saveToLocalStorage();
          //       checkProductInCartForAdded();
          //     }
          //   }
          // };

         

          // const emit = defineEmits();
          
          const saveToWishList = (product) => {
            totalWishlistProduct.value++;

            if (product) {

                let wishList = JSON.parse(localStorage.getItem('wishList')) || [];

                if (Array.isArray(wishList)) {
                    const existingWishListProduct = wishList.find(item => item.id === product.id);

                    if (!existingWishListProduct) {
                        if (isNaN(product.price) || (product.discountPercentage && isNaN(product.discountPercentage))) {
                            alert("Invalid price or discount percentage");
                            return;
                        }

                        const discountPrice = product.discountPercentage
                            ? (product.price - (product.price * product.discountPercentage / 100)).toFixed(2)
                            : product.price.toFixed(2);

                        const discountPriceNum = parseFloat(discountPrice);

                        console.log("discount price", discountPrice);

                        const wishListItem = {
                            id: product.id,
                            title: product.title,
                            images: product.images,
                            discountPrice: discountPriceNum,
                            price: product.price,
                            quantity: 1
                        };

                        wishList.push(wishListItem);
                        localStorage.setItem('wishList', JSON.stringify(wishList));
                        

                        showAlertModal.value = true;
                    } else {
                        alreadyProductAlertModal.value = true;
                    }
                } else {
                    console.error('Expected wishList to be an array, but it is not.');
                }
            }
          };


          const checkProductInCartForAdded = () => {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const existingProduct = cart.find(item => item.id === productInfo.value.id);

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
            const existingProduct = wishList.find(item => item.id === productInfo.value.id);

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
            const updatedCart = cart.filter(item => item.id !== itemId);
            cart.value = updatedCart
            localStorage.setItem('cart', JSON.stringify(updatedCart));
            cartButtonText.value = 'Add to cart';
          };

          const removeItemFromWishList = (itemId) => {
            wishList.value = wishList.value.filter(item => item.id !== itemId);
            localStorage.setItem('wishlist', JSON.stringify(wishList.value));
          };

          const cartIncreaseQuantity = (itemId) => {
            const item = cart.find(item => item.id === itemId);
            if (item) {
              item.quantity++;
              saveToLocalStorage();
            }
          };

          const cartDecreaseQuantity = (itemId) => {
            const item = cart.find(item => item.id === itemId);
            if (item && item.quantity > 1) {
              item.quantity--;
              saveToLocalStorage();
            }
          };


          const wishListIncreaseQuantity = (itemId) => {
            const item = wishList.find(item => item.id === itemId);
            if (item) {
              item.quantity++;
              saveToLocalStorage();
            }
          };

          const wishListDecreaseQuantity = (itemId) => {
            const item = wishList.find(item => item.id === itemId);
            if (item && item.quantity > 1) {
              item.quantity--;
              saveToLocalStorage();
            }
          };

          const moveToCart = (item) => {
            console.log("move to cart");

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

              localStorage.setItem('cart', JSON.stringify(currentCart));
              localStorage.setItem('wishList', JSON.stringify(currentWishList));

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
              wishList = currentWishList.filter(wishListItem => wishListItem.id !== item.id);

              localStorage.setItem('cart', JSON.stringify(currentCart));
              localStorage.setItem('wishList', JSON.stringify(currentWishList));

              cart.value = cart;
              wishList.value = wishList;

              isInWishList.value = false;
              cartButtonText.value = "Added";

              showAlertModal.value = false;
            } else {
              showAlertModal.value = false;
            }
          };

          const paginateProducts = () => {
            const start = (currentPage.value - 1) * productPerPage.value;
            const end = start + productPerPage.value;
            filteredProducts.value = ecommerceData.value.slice(start, end);
          };

          const gotoPage = (page) => {
            currentPage.value = page;
            paginateProducts();
          };

          const previousPage = () => {
            if (currentPage.value > 1) {
              currentPage.value--;
              paginateProducts();
            }
          };

          const nextPage = () => {
            if (currentPage.value < totalPages.value) {
              currentPage.value++;
              paginateProducts();
            }
          };

          const getProduct = async () => {
            if (!enteredProductTitle.value) {
              alert("Enter Valid Product name");
              return;
            }

            try {
              const response = await fetch(`https://dummyjson.com/products/search?q=${enteredProductTitle.value}`);
              const data = await response.json();
              // ecommerceData.splice(0, ecommerceData.length, ...data.products); 
              ecommerceData.value = data.products;
              totalPages.value = Math.ceil(ecommerceData.length / productPerPage.value);
              paginateProducts();
              checkProductInWishList();

              if (enteredProductTitle.value.length >= 3) {
                const searchedProduct = ecommerceData.filter(product => 
                  product.title.toLowerCase().includes(enteredProductTitle.value.toLowerCase())
                );
                if (searchedProduct.length > 0) {
                  ecommerceData.value=searchedProduct; // Update ecommerceData with filtered results
                  totalPages.value = Math.ceil(ecommerceData.length / productPerPage.value);
                  currentPage.value = 1; // Reset to first page after filtering
                  paginateProducts();
                }
              }
            } catch (error) {
              console.log('Error fetching data', error);
            }
          };

          const searchInput = async () => {
            clearTimeout(debounceTimeout.value);

            // Cancel the previous request if any
            if (abortController.value) {
              abortController.value.abort();
            }

            abortController.value = new AbortController();

            debounceTimeout.value = setTimeout(async () => {
              if (enteredProductTitle.value.length >= 3) {
                try {
                  const response = await fetch(`https://dummyjson.com/products/search?q=${enteredProductTitle.value}`, {
                    signal: abortController.value.signal,
                  });

                  if (response.ok) {
                    const data = await response.json();
                    suggestionProduct.value.splice(0, suggestionProduct.value.length, ...data.products);  // Update suggestions
                    filtersApplied.value = true;
                  }
                } catch (error) {
                  if (error.name !== 'AbortError') {
                    console.log("Error fetching suggestions:", error);
                  }
                }
              } else {
                // Clearing suggestions if input length is less than 3 characters
                suggestionProduct.value.splice(0, suggestionProduct.value.length);
              }
            }, 500);
          };

          const selectSuggestion = (product) => {
            clearTimeout(debounceTimeout.value);
            if (abortController.value) {
              abortController.value.abort();
            }

            enteredProductTitle.value = product.title;
            suggestionProduct.value.splice(0, suggestionProduct.value.length);  // Clear suggestions
            filtersApplied.value = true;

            ecommerceData.value.splice(0, ecommerceData.value.length, product); // Set `ecommerceData` to only show the selected product
            totalPages.value = 1;
            currentPage.value = 1;
            paginateProducts();
          };

          const toggleView = (view) => {
            viewMode.value = view;
          };

          const getCategory = async () => {
            try {
              const response = await fetch('https://dummyjson.com/products/category-list');
              const data = await response.json();
              productCategory.value= data; // Update category list
            } catch (error) {
              console.log('Error fetching category', error);
            }
          };

          const filterByCategory = async (cat) => {
                try {
                    if (cat === "") {
                    ecommerceData.value = [...allProductsData.value];
                    } else {
                    const response = await fetch(`https://dummyjson.com/products/category/${cat}`);
                    const data = await response.json();
                    ecommerceData.value = data.products;
                    filtersApplied.value = true;
                    }

                    totalPages.value = Math.ceil(ecommerceData.value.length / productPerPage.value);
                    currentPage.value = 1;
                    paginateProducts();
                } catch (error) {
                    console.log("Fetching category error", error);
                }
            };


          const sortProduct = () => {
            if (sortOrder.value === 'ascending') {
              ecommerceData.sort((a, b) => a.title.localeCompare(b.title));
            } else if (sortOrder.value === "descending") {
              ecommerceData.sort((a, b) => b.title.localeCompare(a.title));
            }

            totalPages.value = Math.ceil(ecommerceData.length / productPerPage.value);
            currentPage.value = 1; // Reset to first page
            paginateProducts();
            filtersApplied.value = true;
          };

          const clearFilters = () => {
            enteredProductTitle.value = '';
            selectedCategory.value = '';
            sortOrder.value = '';
            filtersApplied.value = false;
            allProducts();
          };

          // const calculateTotalVisitCount = () => {
          //   const visitedProducts = JSON.parse(localStorage.getItem('visitedProduct')) || [];
          //   const total = visitedProducts.reduce((sum, product) => sum + product.visitCount, 0);
          //   totalVisitCount.value = total;
            
          // };

          const goToProductDetails = (productId, productTitle) => {
            const visitedProduct = JSON.parse(localStorage.getItem('visitedProduct')) || [];
            
           
            const existProductInVisited = visitedProduct.find(item => item.productId === productId);

            if(!existProductInVisited){
              const currentDate = new Date().toISOString();

              const visitedProductInfo = {
                productId : productId,
                visitCount : 1,
                productTitle : productTitle,
                date : currentDate
              }
              visitedProduct.push(visitedProductInfo)
            }else{
              existProductInVisited.visitCount++;
            }

            localStorage.setItem('visitedProduct', JSON.stringify(visitedProduct));

            const totalVisitCount = visitedProduct.reduce((total, item) => total + item.visitCount, 0);

            localStorage.setItem('totalVisitCount', totalVisitCount);
            window.location.href = `../detail_page/detail.php?id=${productId}`;
            // window.location.href = `../../app_page/detail_page/detail.php?id=${productId}`;
            
            
          };




          return {
                // totalWishListCount,
                visitedProduct,
                visitCount,
                enteredEmail,
                enteredUsername,
                enteredPassword,
                enteredConfirmPassword,
                currentUsername,
                isLoggedIn,
                showSignLoginModal,
                showCreateAccountModal,
                enteredProductTitle,
                ecommerceData,
                allProductData,
                filteredProducts,
                viewMode,
                productCategory,
                selectedCategory,
                sortOrder,
                currentPage,
                productPerPage,
                totalPages,
                suggestionProduct,
                filtersApplied,
                debounceTimeout,
                abortController,
                wishListButtonText,
                showAlertModal,
                alreadyProductAlertModal,
                productInfo,
                productId,
                InputSuggestionProduct,
                placeholder,
                itemToMove,
                cart,
                wishList,
                cartButtonText,
                saveButtonText,
                myCartVisible,
                isInWishList,
                modalMessage,
                similarProducts,
                activeTab,
                showReviewModal,
                currentRating,
                userReviewList,
                totalPrice,
                totalDicountPrice,
                cartItemCount,
                totalWishlistProduct,
                totalProductCount,
               
                signIn,
                createAccount,
                createNewUserAccount,
                getUsernameFromStorage,
                loginUser,
                signOut,
                increaseQuantity,
                decreaseQuantity,
                cartButtonText,
                saveToLocalStorage,
                showMyCart,
                showMyWishList,
                saveToWishList,
                myWishListVisible,
                removeItem,
                removeItemFromWishList,
                cartIncreaseQuantity,
                cartDecreaseQuantity,
                wishListIncreaseQuantity,
                wishListDecreaseQuantity,
                moveToCart,
                modalMessage,
                showAlertModal,
                confirmMoveToCart,
                gotoPage,
                previousPage,
                nextPage,
                getProduct,
                searchInput,
                selectSuggestion,
                toggleView,
                filterByCategory,
                sortProduct,
                clearFilters,
                goToProductDetails,
                totalVisitCount
            };
      }
    }


    
</script>


<style scoped>


/* @media (max-width: 767.98px) { .border-sm-start-none { border-left: none !important; } } */


.bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
}

@media (min-width: 768px) {
    .bd-placeholder-img-lg {
        font-size: 3.5rem;
    }
}

.b-example-divider {
    width: 100%;
    height: 3rem;
    background-color: rgba(0, 0, 0, .1);
    border: solid rgba(0, 0, 0, .15);
    border-width: 1px 0;
    box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
}
.py-5{
    padding-top: 2rem;
}

.b-example-vr {
    flex-shrink: 0;
    width: 1.5rem;
    height: 100vh;
}

.bi {
    vertical-align: -.125em;
    fill: currentColor;
}

.nav-scroller {
    position: relative;
    z-index: 2;
    height: 2.75rem;
    overflow-y: hidden;
}

.nav-scroller .nav {
    display: flex;
    flex-wrap: nowrap;
    padding-bottom: 1rem;
    margin-top: -1px;
    overflow-x: auto;
    text-align: center;
    white-space: nowrap;
    -webkit-overflow-scrolling: touch;
}

.btn-bd-primary {
    --bd-violet-bg: #712cf9;
    --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

    --bs-btn-font-weight: 600;
    --bs-btn-color: var(--bs-white);
    --bs-btn-bg: var(--bd-violet-bg);
    --bs-btn-border-color: var(--bd-violet-bg);
    --bs-btn-hover-color: var(--bs-white);
    --bs-btn-hover-bg: #6528e0;
    --bs-btn-hover-border-color: #6528e0;
    --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
    --bs-btn-active-color: var(--bs-btn-hover-color);
    --bs-btn-active-bg: #5a23c8;
    --bs-btn-active-border-color: #5a23c8;
}

.bd-mode-toggle {
    z-index: 1500;
}

.bd-mode-toggle .dropdown-menu .active .bi {
    display: block !important;
}


.searchBox{
    position: relative;
     display: flex;
     align-items: center;
     width: 600px;
     /* background: white; */
     margin: 20px auto;
     /* border: 1px solid #ddd; */
     /* border-radius: 5px; */
     padding: 5px;

 }
 .searchBox i{
     position: absolute;
     left: 14px;
     color: #888;
     font-size: 13px;
     font-weight: normal;
 }
 .searchBox input{
     flex: 1;
     padding: 12px 100px 12px 30px;
     width: 100%;
     /* height: 40px; */
     border: 0.5px solid #FAF9F6;
     border-radius: 15px;
     outline: none;
     font-size: 12px;
     background-color: #fbfbff;
     color: #033143;
     /* font-family: "Roboto", serif; */
     box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
 }
 .searchBox .search-btn{
     position: absolute;
     right: 9px;
     border: none;
     background-color: #033143;
     color: white;
     padding: 9px 20px;
     border-radius: 17px;
     font-size: 12px;
     cursor: pointer;
 }

 .showProduct{
    display: flex;
    justify-content: flex-end;
    margin-right: 70px;
 }
 .showProduct button{
    margin-right: 10px;
 }



.product-list.list-view .card-body {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.product-list.list-view .card-body .col-md-4 {
  order: 1;
  max-width: 250px; 
}

.product-list.list-view .card-body .col-md-8 {
  order: 2; 
  flex: 1; 
}

.product-list.list-view .card-body .d-flex {
  flex-direction: row; 
}

.product-list.list-view .card-body .d-flex.justify-content-between {
  flex-direction: column; 
}

.suggestion-list {
  max-height: 300px;
  overflow-y: auto;
  border-radius: 0.25rem;
}
.list-unstyled a{
  text-decoration:  none;
  /* color: rgb(80, 187, 229); */
  color: #04a9f5;
}


.text-uppercase{
  color: #033143;
}
button.btn.wishlist-btn{
  color: #033143 !important;
  border: 1px solid #033143;
 
  transition: background-color 0.1s ease !important;
}

button.btn.wishlist-btn:hover {
  color: white !important;
  background-color: #04a9f5;
  cursor: pointer;
  border: none;
}
.ok-btn{
  border: none !important;
  color: white !important;
  background-color: #04a9f5 !important;
}

.addToWishlistBackground-fade{
  background-color: rgba(36, 36, 36, 0.150);
  transition: background-color 0.1s ease;
}

button.checkout{
  border: none;
  background-color: #04a9f5 !important;
} 


.background-fade {
  background-color: rgba(65, 65, 65, 0.513); /* Semi-transparent */
  transition: background-color 0.3s ease;
}


.sticky-header{
  position: fixed !important;
  top: 0 !important;
  left: 0 !important;
  right: 0 !important;
  z-index: 10 !important; 
  background-color: white !important;
  width: 100% !important;
}

</style>