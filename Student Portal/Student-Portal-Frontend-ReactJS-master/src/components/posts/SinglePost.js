import { Box, Chip, Container, Fab, Grid, IconButton, makeStyles, Paper, TextField, Typography, ButtonGroup } from '@material-ui/core';
import { Link, useParams } from 'react-router-dom';
import React, { useEffect, useState } from 'react'
import EditIcon from '@material-ui/icons/Edit';
import DeleteIcon from '@material-ui/icons/Delete';
import CommentOutlinedIcon from '@material-ui/icons/CommentOutlined';
import VisibilityOutlinedIcon from '@material-ui/icons/VisibilityOutlined';
import ArrowUpwardOutlinedIcon from '@material-ui/icons/ArrowUpwardOutlined';
import ArrowDownwardOutlinedIcon from '@material-ui/icons/ArrowDownwardOutlined';
import ToggleButton from '@material-ui/lab/ToggleButton';
import ToggleButtonGroup from '@material-ui/lab/ToggleButtonGroup';
import SendIcon from '@material-ui/icons/Send';
import FaceIcon from '@material-ui/icons/Face';
import { css } from "@emotion/react";
import { ClipLoader, HashLoader } from "react-spinners";
import axios from 'axios';
import { useHistory } from 'react-router-dom';
import Button from '@material-ui/core/Button';
import Comments from './Comments';
import Header from './../Header';
import ShareOutlinedIcon from '@material-ui/icons/ShareOutlined';
//? Time Format Change
import TimeAgo from 'javascript-time-ago'
import ReactTimeAgo from 'react-time-ago'
import en from 'javascript-time-ago/locale/en'


const useStyles = makeStyles((theme) => ({
    paper: {
        padding: theme.spacing(2),
        borderRadius: "10px",
        color: theme.palette.text.secondary,
        marginBottom: theme.spacing(3),
        // margin: theme.spacing(5),
    },
    paperunLogin: {
        padding: theme.spacing(3),
        borderRadius: "10px",
        color: theme.palette.text.secondary,
        // margin: theme.spacing(5),
    },
    paperLogin: {
        padding: theme.spacing(2),
        borderRadius: "10px",
        color: theme.palette.text.secondary,
        // margin: theme.spacing(5),
    },
    postsHeader: {
        marginTop: "-10px",
        marginBottom: "5px",
        borderBottom: "1px solid #e1e8e3"
    },
    postsFooter: {
        marginTop: "8px",
        marginBottom: "-15px",
        borderTop: "1px solid #e1e8e3"
    }

}));
//! For Loading animation -> Start
const override = css`
display: block;
margin: 0 auto;
border-color: green;
`;
const LoadinAnimeStyle = { position: "fixed", top: "50%", left: "50%", transform: "translate(-50%, -50%)" };
//! For Loading animation -> End


const SinglePost = () => {

    let { id } = useParams();
    let [allPosts, setAllPosts] = useState([]);
    let [commentText, setCommentText] = useState([]);
    let [loading, setLoading] = useState(true);
    let history = new useHistory();
    let [comment, setcomment] = useState([]);
    let [vote, setVote] = useState([]);
    // TimeAgo.addDefaultLocale(en)

    const getAllPosts = () => {
        axios.get(`http://127.0.0.1:8000/api/posts/${id}`)
            .then(res => {
                setAllPosts(res.data.post);
                setcomment(res.data.comments);
                setLoading(false);
            });
    }

    useEffect(() => {
        getAllPosts();
        document.title = "Student Portal - Post View"
        console.log(allPosts);
    }, []);


    const classes = useStyles();
    // setLoading(true)

    let handleCommentText = (event) => {
        setCommentText(event.target.value);
    };
    const handleComment = async (event) => {
        event.preventDefault();
        if (commentText !== "") {
            let formData = new FormData();
            formData.append('ctext', commentText)
            try {
                await axios.post(`http://127.0.0.1:8000/api/posts/comment/${id}/${sessionStorage.getItem('id')}`, formData);
                // history.push(`/post/${id}`)
                getAllPosts();
                setCommentText("");

            } catch (error) {
                console.log(error);
            }
        } else {
            alert("Can't Leave empty Comment");
        }

    }
    const [copied, setCopied] = useState(false);

    function copy() {
        const el = document.createElement("input");
        el.value = window.location.href;



        document.body.appendChild(el);
        el.select();
        document.execCommand("copy");
        document.body.removeChild(el);
        setCopied(true);
    }
    const handleDeleteOwnPost = async (event) => {
        event.preventDefault();
        try {
            await axios.delete(`http://127.0.0.1:8000/api/posts/${id}/${sessionStorage.getItem('id')}`);
            history.push(`/`)
        } catch (error) {
            console.log(error);
        }
    }

    const handleVoteDown = (event) => {
        event.preventDefault();
        try {
            axios.post(`http://127.0.0.1:8000/api/posts/vote/downvote/${id}/${sessionStorage.getItem('id')}`);
            getAllPosts();
        } catch (error) {
            console.log(error);
        }
    };
    const handleVoteUp = (event) => {
        event.preventDefault();
        try {
            axios.post(`http://127.0.0.1:8000/api/posts/vote/upvote/${id}/${sessionStorage.getItem('id')}`);
            getAllPosts();
        } catch (error) {
            console.log(error);
        }
    };



    let allComments = (
        <div>
            {comment.map(comment => {

                return (
                    <Comments
                        body={comment.ctext}
                        username={comment.user.uname}
                        time={comment.created_at} />
                )

            })}

        </div>
    );


    return (
        <>
            <div style={LoadinAnimeStyle}>
                <HashLoader loading={loading} color='#39E1FA' size={200} css={override} />
            </div>
            {!loading && <>
                <Header />
                <Container maxWidth="lg">
                    <Grid container spacing={2} justifyContent="center" >
                        <Grid item xs={12} sm={8}>
                            <Paper className={classes.paper} elevation={4}>
                                <Grid container spacing={1} className={classes.postsHeader}>
                                    <Grid item>
                                        {allPosts.category.name}
                                    </Grid>
                                    <Grid item>
                                        <Typography variant="caption" color="textSecondary"> Posted By</Typography>
                                    </Grid>
                                    <Grid item>
                                        <Link to={`/profile/${allPosts.user.uname}`} style={{ textDecoration: 'none' }}>
                                            <Chip
                                                size="small"
                                                icon={<FaceIcon />}
                                                label={allPosts.user.uname}
                                                clickable
                                                color="primary"
                                                variant="outlined"
                                            />
                                        </Link>
                                    </Grid>
                                    <Grid item>
                                        <ReactTimeAgo date={allPosts.created_at} locale="en-US" />
                                    </Grid>
                                    <Grid item lg={5}>
                                    </Grid>
                                    {sessionStorage.getItem('uname') === allPosts.user.uname ? <>
                                        <IconButton size="small" aria-label="delete" className={classes.margin}>
                                            <EditIcon />
                                        </IconButton>

                                        <IconButton size="small" aria-label="delete" className={classes.margin}>
                                            <DeleteIcon onClick={handleDeleteOwnPost} />
                                        </IconButton>
                                    </> : <></>}
                                </Grid>
                                <Grid container spacing={1}>
                                    <h2>{allPosts.title}</h2>
                                </Grid>
                                <Grid container spacing={1}>
                                    <Link to={`/post/fgf`} style={{ textDecoration: 'none', color: 'black' }}>
                                        <Typography variant="body1" color="initial">
                                            {allPosts.pbody}
                                        </Typography>
                                    </Link>
                                </Grid>
                                <Grid container spacing={1} className={classes.postsFooter} alignItems="center">
                                    <Grid item xs={6} sm={5} md={4} lg={2}>
                                        <ButtonGroup size="small" value={vote} color="primary">
                                            <Button value="upvote" aria-label="upvote">
                                                <ArrowUpwardOutlinedIcon onClick={handleVoteUp} />{allPosts.upvotes.length - allPosts.downvotes.length}
                                            </Button>
                                            <Button value="downvote" aria-label="downvote">
                                                <ArrowDownwardOutlinedIcon onClick={handleVoteDown} />
                                            </Button>
                                        </ButtonGroup>


                                    </Grid>
                                    <Grid item xs={2} sm={2} lg={1}>
                                        <Grid container spacing={1} alignItems="center">
                                            <Grid item>
                                                <CommentOutlinedIcon />
                                            </Grid>
                                            <Grid item>
                                                {allPosts.comments.length}
                                            </Grid>
                                        </Grid>

                                    </Grid>
                                    <Grid item xs={2} sm={2} lg={1} justifyContent="center" >
                                        <Grid container spacing={1} alignItems="center">
                                            <Grid item>
                                                <VisibilityOutlinedIcon />
                                            </Grid>
                                            <Grid item>
                                                {allPosts.views === null ? 0 : allPosts.views}
                                            </Grid>
                                        </Grid>
                                    </Grid>
                                    <Grid item xs={2} sm={2} lg={1}>
                                        <IconButton size="small" onClick={copy}>
                                            <ShareOutlinedIcon />{!copied ? "Copy link" : "Copied!"}
                                        </IconButton>
                                    </Grid>
                                </Grid>
                            </Paper>



                            {/* comment section */}

                            <Paper className={classes.paperLogin} elevation={3}>
                                <Grid container spacing={3}>
                                    {sessionStorage.getItem('id') !== null ? <>
                                        <Grid item xs={9} md={10} lg={11}>
                                            <TextField
                                                style={{ width: "100%" }}
                                                id="ctext"
                                                label="Add Comment"
                                                multiline
                                                required
                                                variant="outlined"
                                                onChange={handleCommentText}
                                            />
                                        </Grid>
                                        <Grid item xs={3} md={2} lg={1}>
                                            <Fab color="primary" aria-label="add" className={classes.margin}>
                                                <SendIcon onClick={handleComment} />
                                            </Fab>
                                        </Grid>

                                    </> : <>
                                        <Paper className={classes.paperunLogin} elevation={0}>
                                            <Typography variant="h6" color="initial">Please
                                                <Link style={{ marginLeft: "5px", marginRight: "5px" }} to="/login">
                                                    login
                                                </Link>

                                                to Comment</Typography>
                                        </Paper>
                                    </>}
                                    <Grid item xs={12}>
                                        <h3>Comments</h3>
                                    </Grid>
                                    <Grid item xs={12}>
                                        {allComments}
                                    </Grid>
                                </Grid>
                            </Paper>
                        </Grid>
                    </Grid>
                </Container>
            </>}
        </>
    )
}

export default SinglePost