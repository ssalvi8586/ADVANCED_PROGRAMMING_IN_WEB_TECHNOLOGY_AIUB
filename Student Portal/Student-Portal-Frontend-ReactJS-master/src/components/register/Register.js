import React,{useEffect} from 'react'
import { Link } from "react-router-dom";

import { Grid, Paper, Avatar, Button } from '@material-ui/core';

const Registration = (props) => {
    useEffect(() => {document.title = "Student Portal - Registration"}, []);

  var rootStyle= {
    position: 'absolute',
    top: 0,
    left: 0,
    right: 0,
    bottom: 0,
    backgroundColor: 'rgb(216, 219, 221)'
  }

  
    const paperStyle = { padding: "50px", width: "40%", maxWidth: "400px", minWidth: "300px", margin: "auto", marginTop: "100px", marginBottom: "10%" }
    const headerStyle = { margin: '10px' }
  
    return (
        <div style={rootStyle}>
    
        <div >
        <Paper elevation={10} style={paperStyle}>
        <Grid
                        container
                        direction="column"
                        justifyContent="center"
                        alignItems="center"
                    >
                <Grid align='center'>
                    <Avatar />    
                    <h2 style={headerStyle}>Registration</h2>
                    <br/>
                </Grid>
                    <Link to="/register/student" style={{ textDecoration: 'none' }}><Button variant='contained' color='primary' size="large">Register as a <br/> Student</Button></Link>    
                    <br/>
                    <p>-OR-</p> 
                    <Link to="/register/instructor" style={{ textDecoration: 'none' }}><Button variant='contained' color="secondary" size="large">Register as a <br/>Instructor</Button></Link>    
                    <br/>
                    <p>-OR-</p> 
                    <Link to="/register/moderator" style={{ textDecoration: 'none' }}><Button variant='contained' color='inherit' size="large">Register as a <br/>Moderator</Button></Link>    
                    <br />
 
                <br/>
                <Link to="/login" variant="body2">Already Have an account? Login</Link>
               
            </Grid>
            </Paper>
        </div>
      
        </div>
    );
};

export default Registration;