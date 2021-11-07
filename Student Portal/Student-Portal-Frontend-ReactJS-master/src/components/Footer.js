import { Box, Card, CardContent, Container, Grid, Typography } from '@material-ui/core'

import React from 'react'


const Footer = () => {
    return (
        <>
            <Box
                px={{ xs: 3, sm: 10 }}
                py={{ xs: 5, sm: 10 }}
                bgcolor="text.secondary"
                color="white"
            >
                <Container >
                    <Grid container spacing={5}>
                        <Grid item xs={12} sm={4}>
                            <Box>

                                <Typography variant="h6" gutterBottom>
                                    About us
                                </Typography>
                                <Typography variant="body2" gutterBottom>
                                    Student Portal is an initiative to help Students with the answer.Biggest online
                                    learning platform in Bangladesh! Post questions about anything, get help from experts and share
                                    expertise with others.
                                </Typography>
                            </Box>

                        </Grid>
                        <Grid item xs={12} sm={4}>
                            <Box>
                                <Typography variant="h6" gutterBottom>
                                    Categories
                                </Typography>
                            
                                    <ul className="footer-links">
                                        <li><a href="{{ route('posts.view.cat', 'math') }}">Math</a></li>
                                        <li><a href="{{ route('posts.view.cat', 'physics') }}">Physics</a></li>
                                        <li><a href="{{ route('posts.view.cat', 'chemistry') }}">Chemistry</a></li>
                                        <li><a href="{{ route('posts.view.cat', 'biology') }}">Biology</a></li>
                                        <li><a href="{{ route('posts.view.cat', 'progamming') }}">Progamming</a></li>
                                        <li><a href="{{ route('posts.view.cat', 'gk') }}">General Knowledge</a></li>
                                        <li><a href="{{ route('posts.view.cat', 'economics') }}">Economics</a></li>
                                        <li><a href="{{ route('posts.view.cat', 'exam-prep') }}">Exam Preperation</a></li>
                                    </ul>
                             
                            </Box>

                        </Grid>
                        <Grid item xs={12} sm={4}>
                            <Box>
                                <Typography variant="h6" gutterBottom>
                                    Quick Links
                                </Typography>
                            
                                    <ul className="footer-links">
                                        <li><a href="http://scanfcode.com/about/">About Us</a></li>
                                        <li><a href="http://scanfcode.com/contact/">Contact Us</a></li>
                                        <li><a href="http://scanfcode.com/contribute-at-scanfcode/">Contribute</a></li>
                                        <li><a href="http://scanfcode.com/privacy-policy/">Privacy Policy</a></li>
                                        <li><a href="http://scanfcode.com/sitemap/">Sitemap</a></li>
                                        @if (session()-&gt;get('type')==='admin')
                                        <li><a href="{{ route('admin.dashboard') }}"><b>Admin Panel</b></a></li>
                                        @elseif (session()-&gt;get('type')==='moderator')
                                        <li><a href="{{ route('moderator.dashboard') }}"><b>Moderator Panel</b></a></li>
                                        @endif
                                    </ul>
                            
                            </Box>

                        </Grid>
                    </Grid>
                    <Box textAlign="center"
                        pt={{ xs: 5, sm: 10 }}
                        pb={{ xs: 5, sm: 0 }}
                    >
                        <Typography variant="h6" gutterBottom>
                            Student Portal &reg; {new Date().getFullYear()}
                        </Typography>
                    </Box>
                </Container>
            </Box>
        </>

    )
}

export default Footer
