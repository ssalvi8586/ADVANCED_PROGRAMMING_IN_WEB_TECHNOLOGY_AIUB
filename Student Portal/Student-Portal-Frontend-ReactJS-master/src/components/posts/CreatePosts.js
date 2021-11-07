import { Button, Container, FormControl, Grid, InputLabel, makeStyles, NativeSelect, Paper, Select, TextField } from '@material-ui/core'
import React, { useState, useEffect } from 'react'
import axios from 'axios';
import { css } from "@emotion/react";
import { ClipLoader, HashLoader } from "react-spinners";
import { Link, useHistory } from 'react-router-dom';
import Header from './../Header';


const useStyles = makeStyles((theme) => ({
    formControl: {
        margin: theme.spacing(1),
        minWidth: "75%",
    },

    paper: {
        padding: theme.spacing(2),
        textAlign: 'center',
        color: theme.palette.text.secondary,
        margin: theme.spacing(5),
    },

}));


const CreatePosts = () => {
    let history = useHistory();
    let [loading, setLoading] = useState(true);
    let [categories, setCategories] = useState([]);

    const getCategory = () => {
        axios.get(`http://127.0.0.1:8000/api/categories`)
            .then(res => {
                setCategories(res.data);
                setLoading(false);
                // console.log(res);

            });
    }

    useEffect(() => {
        document.title = "Student Portal - Create Post"
        getCategory();

    }, [])


    //! For Loading animation -> Start
    const override = css`
        display: block;
        margin: 0 auto;
        border-color: green;
    `;
    const LoadinAnimeStyle = { position: "fixed", top: "50%", left: "50%", transform: "translate(-50%, -50%)" };
    //! For Loading animation -> End

    const classes = useStyles();
    const [category, setCategory] = useState()
    const [title, setTitle] = useState()
    const [description, setDescription] = useState()
    const uid = sessionStorage.getItem('id');

    const handleSelectCat = (event) => {
        setCategory(event.target.value);
    };
    const handleTitle = (event) => {
        setTitle(event.target.value);
    };
    const handleDesc = (event) => {
        setDescription(event.target.value);
    };
    const formSubmissionCreatePost = async (event) => {
        event.preventDefault();
        let formData = new FormData();
        formData.append('category', category)
        formData.append('title', title)
        formData.append('description', description)
        formData.append('uid', uid)
        try {
            await axios.post(`http://127.0.0.1:8000/api/create/post`, formData);
            history.push("/?msg=Post%20Created")
        } catch (error) {
            console.log(error);
        }

    }
    if (uid === null) {
        setTimeout(
            () => history.push("/login"), 
            3000
          );
        return (
            <>
        <h1>Unauthorized Access</h1>
        <h3>Redirecting to login</h3>
        </>
        )
    } else {
        return (
            <>
                <div style={LoadinAnimeStyle}>
                    <HashLoader loading={loading} color='#39E1FA' size={200} css={override} />
                </div>
                {!loading && <>
                    <div>
                        <Header />
                        <Container maxWidth="md">
                            <Grid container spacing={3} justifyContent="center">
                                <Grid item xs={12}>
                                    <form onSubmit={formSubmissionCreatePost}>
                                        <Paper className={classes.paper} elevation={5}>
                                            <h1>Create Post</h1>
                                            <FormControl required variant="outlined" className={classes.formControl}>
                                                <InputLabel >Category</InputLabel>
                                                <Select
                                                    native
                                                    onChange={handleSelectCat}
                                                    label="category"
                                                    inputProps={{
                                                        name: 'category',
                                                        id: 'category'
                                                    }}
                                                >
                                                    <option aria-label="None" value="" />
                                                    {categories.map((cat, i) => {
                                                        return (
                                                            <option key={i} value={cat.id}>{cat.name}</option>
                                                        )
                                                    })
                                                    }

                                                </Select>
                                            </FormControl>

                                            <TextField required
                                                label="Title"
                                                onChange={handleTitle}
                                                inputProps={{
                                                    name: 'title',
                                                    id: 'title'
                                                }}
                                                variant="outlined"
                                                className={classes.formControl} />

                                            <TextField
                                                required
                                                label="Post Content"
                                                multiline
                                                rows={4}
                                                variant="outlined"
                                                onChange={handleDesc}
                                                inputProps={{
                                                    name: 'description',
                                                    id: 'description'
                                                }}
                                                className={classes.formControl}
                                            />
                                            <Grid container spacing={5} justifyContent="center">
                                                <Grid item xs={3}>
                                                    <Button type='submit' variant="contained" size="large" color="primary">
                                                        Post
                                                    </Button>
                                                </Grid>
                                                <Grid item xs={5}>
                                                    <Link to="/" style={{ textDecoration: 'none' }} >
                                                        <Button variant="outlined" size="large" color="secondary">
                                                            Cancel
                                                        </Button>
                                                    </Link>
                                                </Grid>
                                            </Grid>
                                        </Paper>
                                    </form>
                                </Grid>
                            </Grid>
                        </Container>
                    </div>
                </>}
            </>
        )
    }
}




export default CreatePosts
