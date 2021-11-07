
import { AppBar, Box, Grid, IconButton, Toolbar, Paper, TextField, Typography, Button, makeStyles, createTheme, ThemeProvider, MenuItem, Container, ListItemText } from '@material-ui/core';

import * as React from 'react';

import { Link, useHistory } from "react-router-dom";

import MenuIcon from '@material-ui/icons/Menu';
import SearchIcon from '@material-ui/icons/Search';
import { blue, green } from '@material-ui/core/colors';
import NotificationsNoneOutlinedIcon from '@material-ui/icons/NotificationsNoneOutlined';
import PersonOutlineOutlinedIcon from '@material-ui/icons/PersonOutlineOutlined';
import Menu from '@material-ui/core/Menu';
import clsx from 'clsx';

import Drawer from '@material-ui/core/Drawer';
import List from '@material-ui/core/List';
import ChevronLeftIcon from '@material-ui/icons/ChevronLeft';
import ChevronRightIcon from '@material-ui/icons/ChevronRight';
import ListItem from '@material-ui/core/ListItem';
import { useEffect, useState } from 'react';
import axios from 'axios';

const drawerWidth = 240;



const useStyles = makeStyles(() => ({

    toolbar: {
        textAlign: "center",
        height: "60px",
        padding: "5px",
        justifyContent: 'center'
    },
    btn: {
        textAlign: "center",
        margin: "1%",
        // marginTop: "3%",
        // padding: '5%'
        // justifyContent: 'end'


    },

    appBarShift: {
        width: `calc(100% - ${drawerWidth}px)`,
        marginLeft: drawerWidth,
        transition: theme.transitions.create(['margin', 'width'], {
            easing: theme.transitions.easing.easeOut,
            duration: theme.transitions.duration.enteringScreen,
        }),
    },
    menuButton: {
        marginRight: theme.spacing(2),
    },
    hide: {
        display: 'none',
    },
    drawer: {
        width: drawerWidth,
        flexShrink: 0,
    },
    drawerPaper: {
        width: drawerWidth,
    },
    drawerHeader: {
        display: 'flex',
        alignItems: 'center',
        padding: theme.spacing(0, 1),
        // necessary for content to be below app bar
        ...theme.mixins.toolbar,
        justifyContent: 'flex-end',
    },
    content: {
        flexGrow: 1,
        padding: theme.spacing(3),
        transition: theme.transitions.create('margin', {
            easing: theme.transitions.easing.sharp,
            duration: theme.transitions.duration.leavingScreen,
        }),
        marginLeft: -drawerWidth,

    },
    contentShift: {
        transition: theme.transitions.create('margin', {
            easing: theme.transitions.easing.easeOut,
            duration: theme.transitions.duration.enteringScreen,
        }),
        marginLeft: 0,
    },
    linksStyle: {
        textDecoration: 'none',
        color: 'black',
    },



}));

const theme = createTheme({
    palette: {
        primary: green,
        secondary: blue,
    },
});

const Header = () => {


    const [open, setOpen] = useState(false);
    const history = new useHistory();
    const [searchText, setSearchText] = useState("");


    const [anchorEl, setAnchorEl] = React.useState(null);

    const handleProfile = (event) => {
        setAnchorEl(event.currentTarget);
    };

    const handleClose = () => {
        setAnchorEl(null);
    };

    const handleLogout = () => {
        sessionStorage.clear();
        history.push("/login");
    };

    const handleDrawerOpen = () => {
        setOpen(true);
    };

    const handleDrawerClose = () => {
        setOpen(false);
    };

    
    let [categories, setCategories] = useState([]);
    
    const getCategory = () => {
        axios.get(`http://127.0.0.1:8000/api/categories`)
        .then(res => {
            setCategories(res.data);
            // setLoading(false);
            console.log(res.data);
        });
    }
    
    useEffect(() => {
        getCategory();

    }, [])
    
    const handleSearchText = event => {
        setSearchText(event.target.value);
    };
    const handleSearchPost = event => {
        history.push(`/posts/search/${searchText}`);
    };
    const classes = useStyles();

    return (
        <div>
            <Container maxWidth="lg">
                <AppBar color='transparent' position='static' alignItems='center' justifyContent='center' elevation={2} style={{ marginBottom: '10px' }}
                    className={clsx({
                        [classes.appBarShift]: open,
                    })}>
                    {/* <Paper elevation={1}> */}
                    <Toolbar className={classes.toolbar} >
                        <Grid container spacing={3} alignItems='center' justifyContent='center' >
                            <Grid item xs>
                                <Grid container alignItems='center' justifyContent="flex-start">
                                    <Grid item xs={3} md={1}  >
                                        <IconButton
                                            size="medium"
                                            edge="start"
                                            color="inherit"
                                            aria-label="menu"
                                            onClick={handleDrawerOpen}
                                            edge="start"
                                            className={clsx(classes.menuButton, open && classes.hide)}
                                        >
                                            <MenuIcon />
                                        </IconButton>
                                    </Grid>
                                    <Grid item xs={8} md={10} lg={8}>
                                        <TextField size="small" style={{ width: '90%' }} onChange={handleSearchText} type="search" variant="outlined" placeholder='Search By Title' />
                                    </Grid>
                                    <Grid item xs={1} md={1}>
                                        <IconButton><SearchIcon onClick={handleSearchPost}/></IconButton>
                                    </Grid>

                                </Grid>
                            </Grid>
                            <Grid item xs={5} lg={4}>
                                <Link to="/" style={{ textDecoration: 'none', color: 'black' }}>
                                    <Typography variant="h4" component="div">Student Potal</Typography>
                                </Link>

                            </Grid>
                            <Grid item xs>
                                {sessionStorage.getItem('uname') === null &&
                                    <ThemeProvider theme={theme}>
                                        <Grid container justifyContent="flex-end">
                                            <Grid style={{ marginRight: "4px" }}>
                                                <Link to="/login" style={{ textDecoration: 'none' }}>
                                                    <Button size='small' variant="outlined" color="secondary" className={classes.btn}>
                                                        Login
                                                    </Button>
                                                </Link>
                                            </Grid >
                                            <Grid style={{ marginLeft: "4px" }}>
                                                <Link to="/register" style={{ textDecoration: 'none' }}>
                                                    <Button size='small' variant="outlined" color="primary" className={classes.btn}>
                                                        Register
                                                    </Button>
                                                </Link>
                                            </Grid>
                                        </Grid>
                                    </ThemeProvider>

                                }
                                {sessionStorage.getItem('uname') !== null &&

                                    <Grid container justifyContent="flex-end" alignitems='center'>
                                        <Grid style={{ marginRight: "4px" }} item xs={4} sm={3} md={2} lg={1}>
                                            <IconButton >
                                                <NotificationsNoneOutlinedIcon />
                                            </IconButton>
                                        </Grid >
                                        <Grid style={{ marginLeft: "4px" }} item xs={6} sm={4} md={3} lg={2}>

                                            <IconButton aria-haspopup="true" onClick={handleProfile}>
                                                <PersonOutlineOutlinedIcon />

                                            </IconButton>
                                            <Menu
                                                id="simple-menu"
                                                anchorEl={anchorEl}
                                                keepMounted
                                                open={Boolean(anchorEl)}
                                                onClose={handleClose}
                                            >
                                                <Link to={`/profile/${sessionStorage.getItem('uname')}`} style={{ textDecoration: 'none' }}>
                                                    <MenuItem onClick={handleClose}>Profile</MenuItem>
                                                </Link>
                                                {sessionStorage.getItem('type') === 'moderator' &&
                                                    <Link to={{ pathname: "http://localhost:3001/" }} target="_blank" style={{ textDecoration: 'none' }}>
                                                        <MenuItem onClick={handleClose}>{`${sessionStorage.getItem('type')}`} panel</MenuItem>
                                                    </Link>
                                                }
                                                {sessionStorage.getItem('type') === 'admin' &&
                                                    <Link to={{ pathname: "http://localhost:3001/" }} target="_blank"  style={{ textDecoration: 'none' }}>
                                                        <MenuItem onClick={handleClose}>{`${sessionStorage.getItem('type')}`} panel</MenuItem>
                                                    </Link>
                                                }
                                                {/* <Link to="#" style={{ textDecoration: 'none' }}> */}
                                                <MenuItem onClick={handleLogout}>Logout</MenuItem>
                                                {/* </Link> */}
                                                


                                            </Menu>


                                        </Grid>
                                    </Grid>


                                }

                            </Grid>



                        </Grid>


                    </Toolbar>
                    {/* </Paper> */}
                </AppBar>
                <Drawer
                    className={classes.drawer}
                    variant="persistent"
                    anchor="left"
                    open={open}
                    classes={{
                        paper: classes.drawerPaper,
                    }}
                >
                    <div className={classes.drawerHeader}>
                        <IconButton onClick={handleDrawerClose}>
                            {theme.direction === 'ltr' ? <ChevronLeftIcon /> : <ChevronRightIcon />}
                        </IconButton>
                    </div>
                    {/* <Divider /> */}
                    <List>
                    {categories.map((category) => (
                            <ListItem button key={category.id}>
                                {/* <ListItemIcon>{index % 2 === 0 ? <InboxIcon /> : <MailIcon />}</ListItemIcon> */}
                                <Link className={classes.linksStyle} to={`/posts/${category.name}`}><ListItemText primary={category.name} /></Link>
                                {/* <ListItemText primary={category.name} /> */}
                            </ListItem>
                        ))}
                    </List>
                </Drawer>
            </Container>



        </div >


    );
};
export default Header;