import { Box, Divider, Grid, makeStyles, Paper } from '@material-ui/core';
import React from 'react'
import { Link } from 'react-router-dom';
//? Time Format Change
import TimeAgo from 'javascript-time-ago'
import ReactTimeAgo from 'react-time-ago'
import en from 'javascript-time-ago/locale/en'


const useStyles = makeStyles((theme) => ({
    title: {
        fontSize: 16,
        textAlign: 'center',
        color: theme.palette.text.secondary,
    },
    paper: {
        padding: theme.spacing(1),
        // textAlign: 'center',
        color: theme.palette.text.secondary,
    },
}));

TimeAgo.addDefaultLocale(en)

const Comments = (props) => {
    const classes = useStyles();
    return (
        <div>
            <Paper className={classes.paper} elevation={2}>
                <Grid container spacing={2} >
                    <Grid item xs={6}>
                        <Link to={`/profile/${props.username}`} style={{ textDecoration: 'none' }}>
                            <b>
                                <Box color="success.main">@{props.username}
                                </Box>
                            </b>
                        </Link>
                    </Grid>
                    <Grid item xs={6} >
                        <Box color="info.main">
                            <ReactTimeAgo date={props.time} locale="en-US" />
                        </Box>
                    </Grid>
                    <Grid item xs={12} >
                        {props.body}
                    </Grid>
                </Grid>
            </Paper>
        </div>
    )
}

export default Comments
