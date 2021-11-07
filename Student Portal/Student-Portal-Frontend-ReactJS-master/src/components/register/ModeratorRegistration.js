import React, { useState,useEffect } from 'react'
import { Link, useHistory } from "react-router-dom";

import InputAdornment from '@material-ui/core/InputAdornment';
import PersonIcon from '@material-ui/icons/Person';
import VpnKeyOutlinedIcon from '@material-ui/icons/VpnKeyOutlined';
import EmailOutlinedIcon from '@material-ui/icons/EmailOutlined';
import PhoneIcon from '@material-ui/icons/Phone';
import ContactMailOutlinedIcon from '@material-ui/icons/ContactMailOutlined';
import ImageOutlinedIcon from '@material-ui/icons/ImageOutlined';
import SupervisedUserCircleOutlinedIcon from '@material-ui/icons/SupervisedUserCircleOutlined';

import { Grid, TextField, Paper, Button } from '@material-ui/core';
import axios from 'axios';


const ModeratorRegistration = (props) => {

    useEffect(() => {document.title = "Student Portal - Moderator Registration"}, []);


    const paperStyle = { padding: "50px", width: "60%", maxWidth: "600px", minWidth: "300px", margin: "auto", marginTop: "5%", marginBottom: "5%" }
    const txtField = { width: "80%", margin: "10px auto" }
    const headerStyle = { margin: '10px' }
    const margin = { margin: "10px auto" }

    const [name, setname] = useState("");
    const [uname, setuname] = useState("");
    const [password, setPassword] = useState("");
    const [cpassword, setCpassword] = useState("");
    const [email, setEmail] = useState("");
    const [contact, setContact] = useState("");
    const [address, setAddress] = useState("");
    const [image, setImage] = useState("");
    // const [errorText, setErrorText] = useState(false);
    // const [errorMsg, setErrorMsg] = useState("");
    const [nameValidation, setNameValidation] = useState("");
    const [unameValidation, setUnameValidation] = useState("");
    const [passwordValidation, setPasswordValidation] = useState("");
    const [cpasswordValidation, setCpasswordValidation] = useState("");
    const [emailValidation, setEmailValidation] = useState("");
    const [contactValidation, setContactValidation] = useState("");
    const [addressValidation, setAddressValidation] = useState("");
    const [imageValidation, setImageValidation] = useState("");
    const [nameValidationText, setNameValidationText] = useState(false);
    const [unameValidationText, setUnameValidationText] = useState(false);
    const [passwordValidationText, setPasswordValidationText] = useState(false);
    const [cpasswordValidationText, setCpasswordValidationText] = useState(false);
    const [emailValidationText, setEmailValidationText] = useState(false);
    const [contactValidationText, setContactValidationText] = useState(false);
    const [addressValidationText, setAddressValidationText] = useState(false);
    const [imageValidationText, setImageValidationText] = useState(false);
    // const [emailServerError, setEmailServerError] = useState("");

    const nameInputChangeHandler = event => {
        setname(event.target.value);
    };
    const unamelInputChangeHandler = event => {
        setuname(event.target.value);

    };
    const passwordInputChangeHandler = event => {
        setPassword(event.target.value);
    };
    const confirmPasswordInputChangeHandler = event => {
        setCpassword(event.target.value);
    };
    const emailInputChangeHandler = (event) => {
        setEmail(event.target.value);
    };
    const ContactInputChangeHandler = event => {
        setContact(event.target.value);
    };
    const addressInputChangeHandler = event => {
        setAddress(event.target.value);
    };
    const imageUploadHandler = event => {
        setImage(event.target.files[0])


    };
    let history = useHistory();

    const formSubmissionHandler = async (event) => {
        event.preventDefault();

        let formData = new FormData()
        formData.append('name', name)
        formData.append('uname', uname)
        formData.append('password', password)
        formData.append('cpassword', cpassword)
        formData.append('email', email)
        formData.append('contact', contact)
        formData.append('address', address)
        formData.append('image', image)
        

            if (name === "" || uname === "" || password === "" || cpassword === "" || email === "" || contact === "" || address === "" || image === "" || password !== cpassword) {
                if(name.length<3){
                    setNameValidation("Full Name is not Valid")
                    setNameValidationText(true)
                }else{
                    setNameValidation("")
                    setNameValidationText(false)
                }
                if(uname.length<6){
                    setUnameValidation("Username Name is not Valid")
                    setUnameValidationText(true)
                    console.log("TEST")
                }else{
                    setUnameValidation("")
                    setUnameValidationText(false)
                }
                if(!/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/.test(password)){
                    setPasswordValidation("Password is not Valid")
                    setPasswordValidationText(true)
                }else{
                    setPasswordValidation("")
                    setPasswordValidationText(false)
                }
                if(password !== cpassword || !cpassword){
                    setCpasswordValidation("Password Does Not Matched")
                    setCpasswordValidationText(true)
                }else{
                    setCpasswordValidation("")
                    setCpasswordValidationText(false)
                }
                if(!/\S+@\S+\.\S+/.test(email)){
                    setEmailValidation("Email is not Valid")
                    setEmailValidationText(true)
                }else{
                    setEmailValidation("")
                    setEmailValidationText(false)
                }
                if(!/(^([+]{1}[8]{2}|0088)?(01){1}[3-9]{1}\d{8})$/.test(contact)){
                    setContactValidation("Phone Number is not Valid")
                    setContactValidationText(true)
                }else{
                    setContactValidation("")
                    setContactValidationText(false)
                }
                if(address.length<3){
                    setAddressValidation("Address is not Valid")
                    setAddressValidationText(true)
                }else{
                    setAddressValidation("")
                    setAddressValidationText(false)
                }
                if(image === ""){
                    setImageValidation("Please Upload Your Profile Picture")
                    setImageValidationText(true)
                }else{
                    setImageValidation("")
                    setImageValidationText(false)
                }
            }
            else{
                try {
                    setEmailValidationText(false)
                    setEmailValidation("")
                    setUnameValidation("")
                    setUnameValidationText(false)
                    setImageValidation("")
                    setImageValidationText(false)
                    setAddressValidation("")
                    setAddressValidationText(false)
                    setContactValidation("")
                    setContactValidationText(false)
                    setCpasswordValidation("")
                    setCpasswordValidationText(false)
                    setPasswordValidation("")
                    setPasswordValidationText(false)
                    setNameValidation("")
                    setNameValidationText(false)
                    const res = await axios.post(`http://127.0.0.1:8000/api/moderator/registration`, formData);
                    console.log(res) 
                    // const serverMsg = res.data
                    // setEmailServerError(res.data.email[0])

                    console.log(res.status)
                    if(res.data !== true){



                        if(typeof(res.data.email) !== 'undefined'){

                            setEmailValidation("Email Has Already Been Taken")

                            setEmailValidationText(true)

                        }

                        if(typeof(res.data.uname) !== 'undefined'){

                            setUnameValidation("Username Has Already Been Taken")

                            setUnameValidationText(true)

                        }

                        if(typeof(res.data.image) !== 'undefined'){

                            setImageValidation("The image must be a file of type: jpeg, jpg, png.")

                            setImageValidationText(true)

                        }

                    }

                    else{



                        history.push("/login?msg=Registration%20Success")

                    }
                
                 
                } catch (errorMsg) {
                    
                console.log(errorMsg);
            }

            }

    };

    // let userData = {name,email,password,confirmPassword, address,contact,uname}

    return (
        <div>
            {/* {console.log(userData)} */}
            <div >
                <Paper elevation={10} style={paperStyle}>
                    <Grid
                        container
                        direction="column"
                        justifyContent="center"
                        alignItems="center"
                    >

                        <SupervisedUserCircleOutlinedIcon />
                        <h2 style={headerStyle}>Moderator Registration</h2>
                        <br />
                        <form className="submit" onSubmit={formSubmissionHandler} >
                            <Grid container spacing={3} justifyContent="center">
                                <Grid item xs={12} sm={6}>

                                    <TextField
                                        // required
                                        error={nameValidationText}
                                        label="Full Name"
                                        variant="outlined"
                                        InputProps={{
                                            startAdornment: <InputAdornment position="start"><PersonIcon /></InputAdornment>,
                                        }}
                                        style={margin}
                                        onChange={nameInputChangeHandler}
                                        helperText={nameValidation}

                                    />
                                </Grid>

                                <Grid item xs={12} sm={6}>
                                    <TextField
                                        // required
                                        error={unameValidationText}
                                        label="Username"
                                        variant="outlined"
                                        InputProps={{
                                            startAdornment: <InputAdornment position="start"><b>@</b></InputAdornment>,
                                        }}
                                        style={margin}
                                        onChange={unamelInputChangeHandler}
                                        helperText={unameValidation}
                                    />
                                </Grid>
                            </Grid>
                            <br />
                            <Grid container spacing={3}>
                                <Grid item xs={12} sm={6}>
                                    <TextField
                                        // required
                                        error={passwordValidationText}
                                        label="Password"
                                        type="password"
                                        variant="outlined"
                                        InputProps={{
                                            startAdornment: <InputAdornment position="start"><VpnKeyOutlinedIcon /></InputAdornment>,
                                        }}
                                        style={margin}
                                        onChange={passwordInputChangeHandler}
                                        helperText={passwordValidation}
                                    />
                                </Grid>
                                <Grid item xs={12} sm={6}>
                                    <TextField
                                        // required
                                        error={cpasswordValidationText}
                                        label="Confirm Password"
                                        type="password"
                                        variant="outlined"
                                        InputProps={{
                                            startAdornment: <InputAdornment position="start"><VpnKeyOutlinedIcon /></InputAdornment>,
                                        }}
                                        style={margin}
                                        onChange={confirmPasswordInputChangeHandler}
                                        helperText={cpasswordValidation}
                                    />
                                </Grid>
                            </Grid>
                            <br />
                            <Grid container spacing={3}>
                                <Grid item xs={12} sm={6}>
                                    <TextField
                                        // required
                                        error={emailValidationText}
                                        label="Email"
                                        
                                        variant="outlined"
                                        InputProps={{
                                            startAdornment: <InputAdornment position="start"><EmailOutlinedIcon /></InputAdornment>,
                                        }}
                                        style={margin}
                                        onChange={emailInputChangeHandler}
                                        helperText={emailValidation}
                                    />
                                </Grid>
                                <Grid item xs={12} sm={6} >
                                    <TextField
                                        // required
                                        error={contactValidationText}
                                        label="Contact No."
                                        variant="outlined"
                                        InputProps={{
                                            startAdornment: <InputAdornment position="start"><PhoneIcon /></InputAdornment>,
                                        }}
                                        style={margin}
                                        onChange={ContactInputChangeHandler}
                                        helperText={contactValidation}
                                    />
                                </Grid>
                            </Grid>
                            <br />


                            <Grid

                                container spacing={3}
                            >
                                <Grid item xs={12}
                                    container
                                    direction="row"
                                    // justifyContent="center"
                                    alignItems="center">
                                    <TextField
                                        // required
                                        error={addressValidationText}
                                        label="Address"
                                        variant="outlined"
                                        InputProps={{
                                            startAdornment: <InputAdornment position="start"><ContactMailOutlinedIcon /></InputAdornment>,
                                        }}
                                        style={txtField}
                                        onChange={addressInputChangeHandler}
                                        helperText={addressValidation}
                                    />
                                </Grid>
                                <br />
                                <br />
                                <Grid item xs={12}
                                    container
                                    direction="row"
                                    // justifyContent="center"
                                    alignItems="center"
                                >
                                    <TextField
                                        // required
                                        error={imageValidationText}
                                        type="file"
                                        label="Profile Picture"
                                        variant="outlined"
                                        InputProps={{
                                            startAdornment: <InputAdornment position="start"><ImageOutlinedIcon /></InputAdornment>
                                        }}
                                        style={txtField}
                                        onChange={imageUploadHandler}
                                        helperText={imageValidation}


                                    />
                                </Grid>
                            </Grid>
                            <br />
                            <Grid
                                container
                                direction="row"
                                justifyContent="center"
                                alignItems="center"
                            >
                                <Button type='submit' variant='contained' color='primary' size="large">Register</Button>
                            </Grid>
                        </form>
                        <br />
                        <Link to="/login" variant="body2">Already Have an account? Login</Link>

                    </Grid>
                </Paper>
            </div>
        </div>
    );
};

export default ModeratorRegistration;
