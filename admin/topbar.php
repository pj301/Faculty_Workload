<style>
	.logo {
    margin: auto;
    font-size: 20px;
    background: white;
    padding: 7px 11px;
    border-radius: 50% 50%;
    color: #000000b3;
}



/* Header Styles */
/* Updated CSS for header and logo */
.header {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 1000;
  height: 12vh;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0px 10px 5px 10px;
  background-color: #213440;
}

.logo-details {
  display: flex;
  align-items: center;
}

.logo-details img {
  height: 80px; /* Adjust the height as needed */
  width: auto;
  margin-left: 10px;
  margin-top: 35px;
}


.header .logo-details .logo_name {
  font-size: 24px;
  font-weight: 600;
  margin-left: -50px;
  margin-top: 18px;
  background: linear-gradient(45deg, red, rgb(255, 255, 255), rgb(255, 2, 200));
  -webkit-background-clip: text;
  color: transparent;
  animation: shiningText 3s infinite;
}

/* ... Other styles ... */


.search-container {
  display: flex;
  align-items: center;
  margin-top: 18px;
}
.search-bar {
  display: flex;
  align-items: center;
  border: 1px solid #ccc;
  border-radius: 4px;
  overflow: hidden;
  margin-left: 1300px;
     position: absolute;
     left: 400px;
     height: 50px;
  width:300px;
  
}

.search-bar input {
  flex-grow: 1;
  padding: 8px; /* Adjusted padding */
  border: none;
  border-radius: 4px;
  outline: none;
  background-color: #213440;
  color: white;
  box-sizing: border-box; /* Include padding and border in total width and height */
  height: 50px;
  width: 300px;
  font-size: 18px;

}


.search-bar button {
  background-color: #213440;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  padding-bottom: 10px;
}
.search-bar.active {
  width: 250px; /* or any desired width */
  transition: width 0.3s ease-in-out;
}

/* Add more styling as needed */

/*CSS CODE FOR PROFILE ON HEADER BAR HERE*/
/* Add more styling as needed */
.profile-icon {
  display: flex;
  align-items: center;
  cursor: pointer;
  margin-top: 5px;
}

.profile-icon img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  margin-right: 10px;
}

.profile-options {
  display: none;
  flex-direction: column;
  position: absolute;
  top: 60px;
  right: 10px;
  z-index: 1000; 
  background-color: #213440;
  border-radius: 4px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  padding: 10px;
}

.profile-options .option {
  padding: 8px;
  color: #ffffff; /* Change this color to your desired text color */
  cursor: pointer;
}
.profile-icon:hover .profile-options {
  display: flex;
}
/* Adjust these styles based on your design preferences */
.profile-options .option:hover {
  background-color: #e4e9f7; /* Change this color to your desired hover background color */
  color: #141d26; /* Change this color to your desired hover text color */
}
/*END OF PROFILE OPTIONS HERE*/
.date-time{
  color: white;
  margin-left: -80px;
  font-size: 12px;
  margin-top: -50px;
}



/* Add this to your existing styles */
.dropdown-menu a.dropdown-item {
    color: #ffffff; /* Text color */
}

.dropdown-menu a.dropdown-item:hover {
    background-color: #018f2b; /* Hover background color */
    color: #ffffff; /* Hover text color */
}

</style>

<header class="header">
        <!-- Header content goes here -->
        <div class="logo-details">
                <img src="../admin/assets/images/logo.png" alt="">
                 <span class="logo_name">FACULTY WORKLOAD</span>
               </div>
               <div class="date-time" id="date-time"></div>
               <div class="search-container">
            <div class="input-group search-bar">
                <input type="text" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                    <button class="btn btn-outline-light" type="button"><i class="fa fa-search fa-sm"></i></button>
                </div>
            </div>
        </div>

              
              <div class="profile-icon">
                <img src="https://gravatar.com/avatar/f57bddebd1edf91412d5d68702530099" alt="profileImg">
                <div class="float-right">
                <div class="dropdown mr-4">
    <a href="#" class="text-white dropdown-toggle" id="account_settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['login_name'] ?></a>
    <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em; background-color: #213440;">
        <a class="dropdown-item" href="javascript:void(0)" id="manage_my_account"><i class="fa fa-cog"></i> Manage Account</a>
        <a class="dropdown-item" href="ajax.php?action=logout"><i class="fa fa-power-off"></i> Logout</a>
    </div>
</div>

      </div>
            </div>
              
    </header>
<script>
  $('#manage_my_account').click(function(){
    uni_modal("Manage Account","manage_user.php?id=<?php echo $_SESSION['login_id'] ?>&mtype=own")
  })
</script>