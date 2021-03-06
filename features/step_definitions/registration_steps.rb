When /^I fill in the captcha$/ do
  # TODO: figure out 1) why 'session != @_webrat_session', and 2) better way to get 'captcha' cookie value
  junk = @_webrat_session.response_headers["set-cookie"]
  junk = CGI::unescape(junk).split('"captcha";s:8:"')
  captcha = junk[1][0,8]
  fill_in "captcha", :with => captcha
end

Given /^I am signed in with username: "([^"]*)", password: "([^"]*)"$/ do |username, password|
  When %{I go to the home page}
  And %{I fill in "username" with "#{username}"}
  And %{I fill in "password" with "#{password}"}
  And %{I press "login"}
end
