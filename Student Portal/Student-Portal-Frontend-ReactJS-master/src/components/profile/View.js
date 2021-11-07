
import React, { useEffect, useState } from 'react'
import Header from './../Header';
import {
    Link,
    useParams
} from "react-router-dom"
import axios from 'axios';

import { Breadcrumbs, CssBaseline, Typography, Container, makeStyles, Paper, Card, CardContent, Grid, Box, Button, Fab } from '@material-ui/core'
import EditIcon from '@material-ui/icons/Edit';
import OwnPost from './OwnPost';
import { css } from "@emotion/react";
import { ClipLoader, HashLoader } from "react-spinners";
import { Alert } from '@material-ui/lab';


const useStyles = makeStyles((theme) => ({
    root: {
        flexGrow: 1,
    },
    paper: {
        padding: theme.spacing(1),
        color: theme.palette.text.secondary,
    },
    username: {
        textAlign: 'center',
        color: theme.palette.text.secondary,
        alignItems: "center",
    },
    margin: {
        margin: "20px auto",
    },

}));


//! For Loading animation -> Start
const override = css`
display: block;
margin: 0 auto;
border-color: green;
`;
const LoadinAnimeStyle = { position: "fixed", top: "50%", left: "50%", transform: "translate(-50%, -50%)" };
//! For Loading animation -> End


const View = (props) => {


    const [errorMsg, setErrorMsg] = useState("");
    const [regMsg, setRegMsg] = useState("");
    const [errorText, setErrorText] = useState(false);


    const errorMessageColor = { color: "red", padding: "10px" }
    const regMsgColor = { color: "green", padding: "10px" }
    useEffect(() => {

        const search = window.location.search;
        const params = new URLSearchParams(search);
        const foo = params.get('msg');
        setRegMsg(foo)
        // console.log(regMsg)

    }, [])



    let { uname } = useParams();

    let [profile, setProfile] = useState([]);
    let [loading, setLoading] = useState(true);

    const [ownPosts, setownPosts] = useState([]);

    const getProfileData = () => {

        axios.get(`http://127.0.0.1:8000/api/profile/${uname}`)
            .then(res => {
                setProfile(res.data);
                setownPosts(res.data.posts)
                setLoading(false);
            });

    }

    useEffect(() => {
        document.title = "Student Portal - Profile"
        getProfileData();

    }, [])

    const classes = useStyles();
    const [showOwnPost, setShowOwnPost] = useState(false);

    const toggleOwnPostHandler = () => {

        const doesShow = showOwnPost;
        setShowOwnPost(!doesShow);
    }

    let posts = null;

    if (showOwnPost) {
        posts = (
            <div>
                {ownPosts.map(ownPosts => {
                    return (
                        <OwnPost title={ownPosts.title}
                            body={ownPosts.pbody}
                            view={ownPosts.views}
                            comment={ownPosts.comments.length} />
                        // <>Hello</>
                    )

                })}

            </div>
        );
    }
    return (
        <>
            <div style={LoadinAnimeStyle}>
                <HashLoader loading={loading} color='#39E1FA' size={200} css={override} />
            </div>
            {!loading && <>
                <Header />
                <Container maxWidth="lg">


                    <Breadcrumbs aria-label="breadcrumb" className={classes.margin}>
                        <Link color="inherit" to="/">
                            Home
                        </Link>
                        <Typography color="textPrimary">Profile</Typography>
                        <Typography color="textPrimary">{uname}</Typography>
                    </Breadcrumbs>
                    <CssBaseline />
                    <Grid item xs={12}>
                        <Container>
                            <div className={classes.root}>
                                <Grid container spacing={3} >
                                    <Grid item xs={12} sm={4} md={4}>
                                        <Card >
                                            <CardContent >
                                                <Grid container spacing={3} >
                                                    <Grid item xs={12}>
                                                        <Box display="flex" justifyContent="center">
                                                            <Box borderRadius="50%" className={classes.imgBorder} >
                                                                <img
                                                                    src={profile.profileInfo !== null ? `http://127.0.0.1:8000/upload/${profile.profileInfo.image}` : ``}
                                                                    alt={`Profile-img`}
                                                                    style={{
                                                                        alignSelf: 'center',
                                                                        height: 150,
                                                                        width: 150,
                                                                        borderWidth: 1,
                                                                        borderRadius: 75,
                                                                    }} />
                                                            </Box>
                                                        </Box>
                                                    </Grid>
                                                    <Grid item xs={12} >
                                                        <h2 className={classes.username}>@{profile.user.uname}</h2>
                                                        <h4 className={classes.username}>{profile.user.type}</h4>

                                                    </Grid>
                                                    {regMsg === null ?
                                                        null
                                                        : <Grid item xs={12}>
                                                            <Alert severity="success">{regMsg}</Alert>
                                                        </Grid>}

                                                    {sessionStorage.getItem('uname') === uname &&
                                                        <>
                                                            <Grid item xs={12} className={classes.username}>

                                                                <Link to={`/profile/${uname}/edit`}>
                                                                    <Fab >
                                                                        <EditIcon />
                                                                    </Fab>
                                                                </Link>
                                                            </Grid>

                                                        </>
                                                    }

                                                </Grid>
                                            </CardContent>
                                        </Card>
                                    </Grid>
                                    <Grid item xs={12} sm={8} md={8}>
                                        <Card >
                                            <CardContent >
                                                <Grid container spacing={3}>
                                                    <Grid item xs={4} sm={3} lg={2}>
                                                        <Paper className={classes.paper}><b>Full Name:</b></Paper>
                                                    </Grid>
                                                    <Grid item xs={8} sm={9} lg={10}>
                                                        <Paper className={classes.paper}>
                                                            {profile.profileInfo !== null ? profile.profileInfo.name : 'UNKNOWN'}
                                                        </Paper>
                                                    </Grid>
                                                    <Grid item xs={4} sm={3} lg={2}>
                                                        <Paper className={classes.paper}><b>Email:</b></Paper>
                                                    </Grid>
                                                    <Grid item xs={8} sm={9} lg={10}>
                                                        <Paper className={classes.paper}>
                                                            {profile.profileInfo !== null ? profile.profileInfo.email : 'UNKNOWN'}
                                                        </Paper>
                                                    </Grid>
                                                    <Grid item xs={4} sm={3} lg={2}>
                                                        <Paper className={classes.paper}><b>Phone:</b></Paper>
                                                    </Grid>
                                                    <Grid item xs={8} sm={9} lg={10}>
                                                        <Paper className={classes.paper}>
                                                            {profile.profileInfo !== null ? profile.profileInfo.contact : 'UNKNOWN'}
                                                        </Paper>
                                                    </Grid>
                                                    <Grid item xs={4} sm={3} lg={2}>
                                                        <Paper className={classes.paper}><b>Address:</b></Paper>
                                                    </Grid>
                                                    <Grid item xs={8} sm={9} lg={10}>
                                                        <Paper className={classes.paper}>
                                                            {profile.profileInfo !== null ? profile.profileInfo.address : 'UNKNOWN'}
                                                        </Paper>
                                                    </Grid>
                                                </Grid>

                                            </CardContent>
                                        </Card>
                                        <Grid>
                                            <Card className={classes.margin} color="primary">
                                                <CardContent >
                                                    <Grid container spacing={3}>
                                                        <Button className={classes.margin} onClick={toggleOwnPostHandler} variant="contained" color="primary">
                                                            {/* {uname}'s Post */}
                                                            My Posts
                                                        </Button>
                                                    </Grid>
                                                    {
                                                        posts
                                                    }
                                                </CardContent>
                                            </Card>
                                        </Grid>
                                    </Grid>

                                </Grid>
                            </div>
                        </Container>
                    </Grid>

                </Container>
            </>}
        </>
    )
}

export default View
