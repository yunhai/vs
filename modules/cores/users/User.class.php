<?php 

class User extends BasicObject {

	public	function convertToDB(){
		$map = array(
			     'id', 'name', 'password', 'group_code', 'email', 'fullname', 'address', 'city', 'location', 'zipcode', 'lastlogin', 'joinDate', 'status', 'website'
		      );
		
        foreach($map as $key) {
		    isset ( $this->$key ) ? ($dbobj [$key] = $this->$key) : '';
		}
		      
		return $dbobj;
	}


	public function convertToObject($object = array()){
		$map = array(
                'id', 'name', 'password', 'group_code', 'email', 'fullname', 'address', 'city', 'location', 'zipcode', 'lastlogin', 'joinDate', 'status', 'website'
		);
		
		foreach($map as $key) {
		    isset ( $object [$key] ) ? ( $this->$key = $object [$key] ) : '';
		}
	}

	function validate() {
	    $status = true;
	    return $status;
	}

	function getGroupCode() {
	    return $this->group_code;
	}
	
    function getFullname() {
        return $this->fullname;
    }

	function getId(){
		return $this->id;
	}


	function getName(){
		return $this->name;
	}



	function getZipcode(){
		return $this->zipcode;
	}



	function getEmail(){
		return $this->email;
	}


	function getWebsite(){
	    return $this->website;
	}
	

	function getStatus(){
		return $this->status;
	}


	function getAddress(){
		return $this->address;
	}



	function getCity(){
		return $this->city;
	}

	function getLocation(){
		return $this->location;
	}



	function setId($id){
		$this->id=$id;
	}




	function setName($name){
		$this->name=$name;
	}




	function setPassword($password){
		$this->password=$password;
	}




	function setEmail($email){
		$this->email=$email;
	}




	function setPostDate($postDate){
		$this->postDate=$postDate;
	}




	function setStatus($status){
		$this->status=$status;
	}




	function setImage($image){
		$this->image=$image;
	}




	function setFirstName($firstName){
		$this->firstName=$firstName;
	}




	function setTitle($title){
		$this->title=$title;
	}




	function setGender($gender){
		$this->gender=$gender;
	}




	function setMinutes($minutes){
		$this->minutes=$minutes;
	}




	function setHour($hour){
		$this->hour=$hour;
	}




	function setDay($day){
		$this->day=$day;
	}




	function setMonth($month){
		$this->month=$month;
	}




	function setYear($year){
		$this->year=$year;
	}




	function setPhone($phone){
		$this->phone=$phone;
	}




	function setMobile($mobile){
		$this->mobile=$mobile;
	}




	function setCompany($company){
		$this->company=$company;
	}




	function setInterested($interested){
		$this->interested=$interested;
	}




	function setFax($fax){
		$this->fax=$fax;
	}




	function setAddress($address){
		$this->address=$address;
	}




	function setProvince($province){
		$this->province=$province;
	}




	function setSkype($skype){
		$this->skype=$skype;
	}




	function setYahoo($yahoo){
		$this->yahoo=$yahoo;
	}




	function setCountry($country){
		$this->country=$country;
	}




	function setScore($score){
		$this->score=$score;
	}




	function setIntro($intro){
		$this->intro=$intro;
	}




	function setLocation($location){
		$this->location=$location;
	}



		var		$id;

		var		$name;

		var		$password;

		var		$email;

		var		$status;

		var		$location;
}
