import React from 'react';
import Home from './components/Home'
import CategoryPage from './components/CategoryPage'
import SearchPostPage from './components/SearchPostPage'
import Login from './components/Login'
import Register from './components/register/Register'
import InstructorRegistration from './components/register/InstructorRegistration'
import ModeratorRegistration from './components/register/ModeratorRegistration'
import StudentRegistration from './components/register/StudentRegistration'
import './App.css';
import {BrowserRouter as Router, Switch, Route} from "react-router-dom"
import View from './components/profile/View';
import Edit from './components/profile/Edit';
import CreatePosts from './components/posts/CreatePosts';
import SinglePost from './components/posts/SinglePost';

function App() {
  return (
    <>
      <Router>
        <Switch>
          <Route exact path="/">
              <Home/>
          </Route>
          <Route exact path="/login">
              <Login/>
          </Route>
          <Route exact path="/register">
              <Register/>
          </Route>
          <Route exact path="/register/instructor">
              <InstructorRegistration/>
          </Route>
          <Route exact path="/register/moderator">
              <ModeratorRegistration/>
          </Route>
          <Route exact path="/register/student">
              <StudentRegistration/>
          </Route>
          <Route exact path="/profile/:uname">
              <View/>
          </Route>
          <Route exact path="/profile/:uname/edit">
              <Edit/>
          </Route>
          <Route exact path="/posts/create">
              <CreatePosts/>
          </Route>
          <Route exact path="/post/:id">
              <SinglePost/>
          </Route>
          <Route exact path="/posts/:cat">
              <CategoryPage/>
          </Route>
          <Route exact path="/posts/search/:text">
              <SearchPostPage/>
          </Route>
        </Switch>
      </Router>
    </>
  );
}

export default App;