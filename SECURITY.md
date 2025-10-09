# Security Improvements Documentation

## Overview
This document outlines the security vulnerabilities that were identified and fixed in the Hitthegrounds application, specifically related to the JWT authentication and verification code systems.

## Vulnerabilities Fixed

### 1. **Rate Limiting** ✅
**Issue:** No rate limiting on verification code sending and verification attempts, enabling:
- Denial of Service (DoS) attacks through spam
- Brute force attacks on verification codes
- Email bombing attacks

**Fix:**
- Added rate limiting to `sendCode()`: Maximum 3 attempts per 5 minutes per email
- Added rate limiting to `verify()`: Maximum 5 verification attempts per 15 minutes per user
- Added rate limiting to `register()`: Maximum 3 registration attempts per 5 minutes per email

**Location:**
- `resources/views/livewire/company-login-form.blade.php`
- `resources/views/livewire/company-registration-form.blade.php`

### 2. **Verification Code Security** ✅
**Issue:** Verification codes stored in plain text in the database, making them vulnerable if database is compromised.

**Fix:**
- Implemented SHA-256 hashing for verification codes before storage
- Codes are hashed using `hash('sha256', $code)` before database insertion
- Comparison uses hashed values, preventing timing attacks

**Location:**
- `resources/views/livewire/company-login-form.blade.php`
- `resources/views/livewire/company-registration-form.blade.php`

### 3. **Cookie Security** ✅
**Issue:** JWT token cookie had hardcoded `secure` flag, causing issues in local development.

**Fix:**
- Made `secure` flag environment-aware: `$secure = config('app.env') !== 'local'`
- Secure flag is `true` in production, `false` in local development
- Maintains httpOnly and SameSite=strict flags

**Location:**
- `resources/views/livewire/company-login-form.blade.php`
- `resources/views/livewire/company-registration-form.blade.php`

### 4. **Database Cleanup** ✅
**Issue:** Expired and used verification codes accumulated in database, causing:
- Database bloat
- Potential security risks from old codes
- Performance degradation

**Fix:**
- Created cleanup command: `php artisan verification-codes:cleanup`
- Scheduled to run daily via `routes/console.php`
- Deletes codes that are either expired OR used

**Location:**
- `app/Console/Commands/CleanupExpiredVerificationCodes.php`
- `routes/console.php`

### 5. **User Enumeration Prevention** ✅
**Issue:** Different error messages revealed whether an email exists in the system.

**Fix:**
- Implemented generic error message: "If an account exists with this email, a verification code will be sent."
- Same error shown regardless of whether user exists
- Still applies rate limiting to prevent abuse

**Location:**
- `resources/views/livewire/company-login-form.blade.php`

### 6. **JWT Secret Validation** ✅
**Issue:** No validation that JWT_SECRET is properly configured, potentially allowing weak or missing secrets.

**Fix:**
- Added runtime validation in JWTService constructor
- Checks that JWT_SECRET is not empty
- Validates that decoded secret is at least 32 bytes (required for HS256)
- Throws clear error messages if validation fails

**Location:**
- `app/Services/JWTService.php`

## Configuration

### Environment Variables
Add the following to your `.env` file:

```bash
# JWT Configuration
# Generate with: php -r "echo base64_encode(random_bytes(64));"
JWT_SECRET=your-base64-encoded-secret-here
JWT_ALGO=HS256
JWT_TTL=43200  # Token TTL in minutes (default: 30 days)
```

### Generating a Secure JWT Secret
Run this command to generate a cryptographically secure JWT secret:

```bash
php -r "echo base64_encode(random_bytes(64));"
```

Copy the output to your `.env` file as the value for `JWT_SECRET`.

## Scheduled Tasks

The verification code cleanup runs automatically via Laravel's scheduler. Ensure your cron is configured:

```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

Or manually run the cleanup:

```bash
php artisan verification-codes:cleanup
```

## Testing

Security-focused tests have been created to validate these fixes:

### Run Verification Code Security Tests
```bash
php artisan test --filter=VerificationCodeSecurityTest
```

### Run JWT Security Tests
```bash
php artisan test --filter=JWTSecurityTest
```

### Run All Security Tests
```bash
php artisan test tests/Feature/VerificationCodeSecurityTest.php tests/Feature/JWTSecurityTest.php
```

## Security Best Practices Implemented

1. ✅ **Defense in Depth**: Multiple layers of security (rate limiting, hashing, validation)
2. ✅ **Principle of Least Privilege**: Minimal error information exposed to users
3. ✅ **Secure by Default**: Environment-aware security settings
4. ✅ **Data Minimization**: Automatic cleanup of sensitive data
5. ✅ **Input Validation**: Strong validation on all user inputs
6. ✅ **Cryptographic Security**: Strong hashing algorithms (SHA-256 for codes, HS256 for JWT)
7. ✅ **Rate Limiting**: Protection against brute force and DoS attacks

## Migration Notes

### Database Schema
No database migration is required. The existing `verification_codes` table schema supports hashed codes:
- `code` column stores the SHA-256 hash (64 characters)
- Existing codes will be invalid after deployment (users will need to request new codes)

### Deployment Checklist
1. ✅ Set `JWT_SECRET` in production `.env` file (use strong 64-byte secret)
2. ✅ Verify `APP_ENV=production` in production
3. ✅ Configure cron for scheduled tasks
4. ✅ Run tests to ensure everything works: `php artisan test`
5. ✅ Clear cache: `php artisan config:clear && php artisan cache:clear`

## Monitoring Recommendations

Monitor the following for security incidents:

1. **Rate Limit Hits**: Track users hitting rate limits (potential attack indicators)
2. **Failed Verification Attempts**: Multiple failed verifications from same user/IP
3. **JWT Validation Failures**: Could indicate token tampering attempts
4. **Database Growth**: Monitor `verification_codes` table size

## Additional Security Recommendations

While the current fixes address the identified vulnerabilities, consider these additional enhancements:

1. **Add IP-based rate limiting** in addition to email-based
2. **Implement CAPTCHA** for registration and login after rate limit hits
3. **Add security headers** (CSP, HSTS, X-Frame-Options)
4. **Enable audit logging** for authentication events
5. **Implement 2FA** for high-privilege accounts
6. **Regular security audits** and dependency updates

## Support

For security concerns or questions, please contact the security team or open a confidential issue.
