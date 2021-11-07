import React, { useEffect, useState } from 'react'
import { Card, CardContent, Container, Divider, List, ListItem, ListItemText, makeStyles, Paper, Typography } from '@material-ui/core'
import { css } from "@emotion/react";
import { ClipLoader, HashLoader, PuffLoader } from "react-spinners";
import axios from 'axios';
import { Link } from 'react-router-dom';


const useStyles = makeStyles({
    card: {
        width: "100%",
        justifyContent: "center",
        padding: "10px",
        marginBottom: "10px",
        borderRadius: "10px"
    },
    links: {
        marginLeft: "15px",
        marginTop: "-10px",
        marginRight: "50px"
    },
    linksStyle: {
        textDecoration: 'none',
        color: 'black',
    }
});

const AboutUs = () => {

    const classes = useStyles();
    // let [loading, setLoading] = useState(true);
    let [categories, setCategories] = useState([]);

    const getCategory = () => {
        axios.get(`http://127.0.0.1:8000/api/categories`)
            .then(res => {
                setCategories(res.data);
                // setLoading(false);
            });
    }

    useEffect(() => {
        getCategory();

    }, [])




    return (

        <div>
            <Container justifyContent="center">
                <Paper elevation={5} className={classes.card}>
                    <Typography variant="body1" color="initial">About</Typography>
                    <br />
                    <Typography variant="body2" color="initial" align="justify">
                        Student Portal is an initiative to help Students with the answer.Biggest online
                        learning platform in Bangladesh! Post questions about anything, get help from experts and share
                        expertise with others.
                    </Typography>
                </Paper>
                <Paper elevation={5} className={classes.card}>
                    <Typography variant="body1" color="initial">Categories</Typography>
                    <br />
                    {/* <HashLoader loading={loading} color='#39E1FA' size={100} />
                    {!loading && <> */}

                        <List component="nav" className={classes.links}>
                            {categories.map(category => {
                                return (
                                    <>
                                        <Link className={classes.linksStyle} to={`/posts/${category.name}`}>{category.name}</Link>
                                        <Divider style={{ marginTop: "5px", marginBottom: "5px" }} />
                                    </>

                                )
                            })}
                        </List>

                    {/* </>} */}
                </Paper>
                <Paper elevation={5} className={classes.card}>
                    <Typography variant="body1" color="initial">Quick Links</Typography>
                    <br />
                    {/* <HashLoader loading={loading} color='#39E1FA' size={100} />
                    {!loading && <> */}

                        <List component="nav" className={classes.links}>
                            <Link className={classes.linksStyle} to={`#`}>About Us</Link>
                            <Divider style={{ marginTop: "5px", marginBottom: "5px" }} />
                            <Link className={classes.linksStyle} to={`#`}>Contact Us</Link>
                            <Divider style={{ marginTop: "5px", marginBottom: "5px" }} />
                            <Link className={classes.linksStyle} to={`#`}>Privacy Policy</Link>
                            <Divider style={{ marginTop: "5px", marginBottom: "5px" }} />
                        </List>

                    {/* </>} */}
                </Paper>

            </Container>


        </div>
    )
}

export default AboutUs
