import { Typography, makeStyles, Grid, Paper } from '@material-ui/core'
import React from 'react'



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


const OwnPost = (props) => {
    const classes = useStyles();
    return (
        <div>
            <Grid container spacing={2}>
                <Grid item xs={3} >
                    <Paper className={classes.paper} elevation={0}>
                        <Grid item xs={12} >
                            <Grid item xs={7} >
                                <Paper className={classes.paper} elevation={0}>
                                    {props.comment} <b>Comment</b>
                                </Paper>
                            </Grid>
                            <Grid item xs={5} >
                                <Paper className={classes.paper} elevation={0}>
                                {props.view} <b>Views</b>
                                </Paper>
                            </Grid>
                        </Grid>
                    </Paper>
                </Grid>
                <Grid item xs={9}>
                    <Paper className={classes.paper}>
                        <Typography className={classes.title} gutterBottom>
                            <b>{props.title}</b>
                        </Typography>
                        <Typography gutterBottom>
                        {props.body}
                        </Typography>
                    </Paper>
                </Grid>

            </Grid>
        </div>
    )
}

export default OwnPost
