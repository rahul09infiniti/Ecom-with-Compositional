<template>
  <div>
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

                      <button v-if="isLoggedIn" @click="signOut" type="button" class="btn btn-primary position-relative border rounded py-1 px-3 d-none d-md-block mb-0" style="background-color: white; color: #033143; margin-right: 15px;"><i class="fa fa-user m-1 me-md-2" style="color: #033143; cursor: pointer; font-size: 1.2rem;"></i>
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
  </div>
</template>

<script type="module">

</script>

<style scoped>
.sticky-header{
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 10; 
  background-color: white;
  width: 100%;
}
</style>