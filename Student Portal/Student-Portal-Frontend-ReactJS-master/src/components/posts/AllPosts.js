import { Box, Chip, Fab, Grid, IconButton, makeStyles, Paper, TextField, Typography, Button, ButtonGroup } from '@material-ui/core';
import React, { useState } from 'react'
import { Link } from 'react-router-dom';
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
//? Time Format Change
import TimeAgo from 'javascript-time-ago'
import ReactTimeAgo from 'react-time-ago'
import en from 'javascript-time-ago/locale/en'
//? Read More
import ReadMoreReact from 'read-more-react';


const useStyles = makeStyles((theme) => ({

    paper: {
        padding: theme.spacing(2),
        borderRadius: "10px",
        color: theme.palette.text.secondary,
        marginBottom: theme.spacing(3),
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

TimeAgo.addDefaultLocale(en)

const AllPosts = (props) => {
    const classes = useStyles();

    const [vote, setVote] = React.useState('');

    const handleVote = (event, status) => {
        event.preventDefault();
        setVote(status);
    };


    return (
        <>
            <Paper className={classes.paper} elevation={4}>
                <Grid container spacing={1} className={classes.postsHeader}>
                    <Grid item>
                        {props.category}
                    </Grid>
                    <Grid item>
                        <Typography variant="caption" color="textSecondary"> Posted By</Typography>
                    </Grid>
                    <Grid item>
                        <Link to={`/profile/${props.postUser}`} style={{ textDecoration: 'none' }}>
                            <Chip
                                size="small"
                                icon={<FaceIcon />}
                                label={props.postUser}
                                clickable
                                color="primary"
                                variant="outlined"
                            />
                        </Link>
                    </Grid>
                    <Grid item>
                        <ReactTimeAgo date={props.postTime} locale="en-US" />
                    </Grid>
                </Grid>
                <Grid container spacing={1}>
                    <h2>{props.title}</h2>
                </Grid>
                <Grid container spacing={1}>
                    <Link to={`/post/${props.pid}`} style={{ textDecoration: 'none',color:'black' }}>
                        <Typography variant="body1" color="initial">
                            <ReadMoreReact text={props.body} />
                        </Typography>
                    </Link>
                </Grid>
                <Grid container spacing={1} className={classes.postsFooter} alignItems="center">
                    <Grid item xs={6} sm={5} md={4} lg={2}>
                        <ToggleButtonGroup size="small" value={vote} color="primary" onChange={handleVote}>
                            <ToggleButton value="upvote" aria-label="upvote">
                                <ArrowUpwardOutlinedIcon />{props.votes}
                            </ToggleButton>
                            <ToggleButton value="downvote" aria-label="downvote">
                                <ArrowDownwardOutlinedIcon />
                            </ToggleButton>
                        </ToggleButtonGroup>


                    </Grid>
                    <Grid item xs={2} sm={2} lg={1}>

                        <Grid container spacing={1} alignItems="center">
                            <Grid item>
                                <CommentOutlinedIcon />
                            </Grid>
                            <Grid item>
                                {props.comment}
                            </Grid>
                        </Grid>

                    </Grid>
                    <Grid item xs={2} sm={2} lg={1} justifyContent="center" >
                        <Grid container spacing={1} alignItems="center">
                            <Grid item>
                                <VisibilityOutlinedIcon />
                            </Grid>
                            <Grid item>
                                {props.view===null? 0 :props.view}
                            </Grid>
                        </Grid>

                    </Grid>
                </Grid>
            </Paper>

        </>

    )
}

export default AllPosts
