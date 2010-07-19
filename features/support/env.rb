### prerequisites ###

require 'spec/expectations'

require 'ruby-debug'

require 'webrat'

require 'pickle/world'

require 'test/unit/assertions'
World(Test::Unit::Assertions)

Webrat.configure do |config|
  config.mode = :mechanize
end

World do
  session = Webrat::Session.new
  session.extend(Webrat::Methods)
  session.extend(Webrat::Matchers)
  session
end


### minimal interface to data model ###

require 'active_record'

ActiveRecord::Base.establish_connection(
  :adapter => 'mysql',
  :database => 'cpodz',
  :username => 'cpodz_user',
  :password => 'bob',
  :host => 'localhost')

require 'authlogic'
class Account < ActiveRecord::Base
  acts_as_authentic do |authconfig|
    authconfig.require_password_confirmation = false

    # NB: AuthLogic doesn't like you to have a
    authconfig.crypted_password_field = :passwd
    authconfig.password_salt_field = :salt

    authconfig.crypto_provider = Authlogic::CryptoProviders::Sha1
    Authlogic::CryptoProviders::Sha1.join_token = ""
    Authlogic::CryptoProviders::Sha1.stretches = 1
  end
end


### helpers ###

def run(cmd)
  `#{cmd}`
end