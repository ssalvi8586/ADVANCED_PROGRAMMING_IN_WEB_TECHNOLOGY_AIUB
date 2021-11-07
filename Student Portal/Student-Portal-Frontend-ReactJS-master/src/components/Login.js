import React, { useEffect, useState } from 'react'
import axios from 'axios';
import {
    Link,
    useHistory
} from "react-router-dom"

import { Grid, TextField, Paper, Avatar, Button } from '@material-ui/core';
import { css } from "@emotion/react";
import { ClipLoader, HashLoader } from "react-spinners";
import { render } from 'react-dom';


//! For Loading animation -> Start
const override = css`
display: block;
margin: 0 auto;
border-color: green;
`;
const LoadinAnimeStyle = { position: "fixed", top: "50%", left: "50%", transform: "translate(-50%, -50%)" };
//! For Loading animation -> End


const Login = (props) => {


    const [uname, setUsername] = useState("");
    const [password, setPassword] = useState("");
    const [errorMsg, setErrorMsg] = useState("");
    const [regMsg, setRegMsg] = useState("");
    const [errorText, setErrorText] = useState(false);
    let [loading, setLoading] = useState(true);


    const usernamelInputChangeHandler = event => {
        setUsername(event.target.value);
    };
    const passwordInputChangeHandler = event => {
        setPassword(event.target.value);
    };
    let history = useHistory();

    const formSubmissionHandler = async (event) => {
        event.preventDefault();

        let result = { uname, password }
        console.log(result);
        setLoading(false);
        
        axios.post(`http://127.0.0.1:8000/api/login`, result)
        .then(res => {
            if (res.data.id == null) {
                setLoading(true);
                setErrorMsg('Username or Password Invalid')
                setErrorText(true);
                    console.log(errorText)
                }
                else {
                    //For Session use through all website
                    sessionStorage.setItem('id', res.data.id);
                    sessionStorage.setItem('token', res.data.token);
                    sessionStorage.setItem('uname', res.data.uname);
                    sessionStorage.setItem('type', res.data.type);

                    history.push('/')
                }
            })
    };


    const paperStyle = { padding: "50px", width: "30%", maxWidth: "300px", margin: "auto", marginTop: "150px" }
    const headerStyle = { margin: '10px' }
    const margin = { margin: "10px auto" }
    const errorMessageColor = { color: "red", padding: "10px" }
    const regMsgColor = { color: "green", padding: "10px" }
    useEffect(() => {
        document.title = "Student Portal - Login"
        const search = window.location.search;
        const params = new URLSearchParams(search);
        const foo = params.get('msg');
        setRegMsg(foo)
        // console.log(regMsg)

    }, [])

    return (
        <>
        <div style={LoadinAnimeStyle}>
                <HashLoader loading={!loading} color='#39E1FA' size={200} css={override} />
            </div>
            {loading && <>
                <div>
                    <div >
                        <Paper elevation={10} style={paperStyle}>
                            <Grid
                                container

                                direction="column"
                                justifyContent="center"
                                alignItems="center"
                            >

                                <Avatar />
                                <h2 style={headerStyle}>Login</h2>
                                <form className="submit" onSubmit={formSubmissionHandler}>
                                    {/* <TextField id="outlined-basic" label="Outlined" variant="outlined" /> */}
                                    <TextField
                                        required
                                        error={errorText}
                                        label="Username"
                                        variant="outlined"
                                        style={margin}
                                        onChange={usernamelInputChangeHandler}
                                    />
                                    <br />
                                    <TextField
                                        required
                                        error={errorText}
                                        // id="outlined-password-input"
                                        label="Password"
                                        type="password"
                                        variant="outlined"
                                        style={margin}
                                        onChange={passwordInputChangeHandler}
                                    />
                                    <br /><br />
                                    <Grid
                                        container
                                        direction="row"
                                        justifyContent="center"
                                        alignItems="center"
                                    >
                                        <Button type='submit' variant='contained' color='primary' size="large">Login</Button>
                                    </Grid>
                                </form>

                                <span style={errorMessageColor}><b>{errorMsg}</b></span>
                                <span style={regMsgColor}><b>{regMsg}</b></span>


                                <Link to="/register"> New here? Sign Up</Link>


                            </Grid>
                        </Paper>
                    </div>

                </div>
            </>}
        </>
    );
};

export default Login;